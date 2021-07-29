<?php

//Creates variables for database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "final";

//May need to alter port depending on system. Mine used 3308
$conn = @mysqli_connect($servername, $username, $password, $dbname, 3308);

if (!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

//Checks to see if any call was used. If so, runs that method
if (!empty($_GET['ItemToAdd'])){
    addItem();
} if (!empty($_GET['ItemToRemove'])){
    removeItem();
} if (!empty($_GET['EmptyCart'])){
    emptyOrder();
}

function addItem(){
    //Adds item to order, as well as unique session id and price
    global $conn;
    $ProdID = $_GET['ItemToAdd'];
    $SessionID = $_GET['PHPSESSID'];
    if ($ProdID == "Players Handbook" || $ProdID == "Dungeon Masters Guide" || $ProdID == "Monster Manual"){
        $Price = 49.95;
    }
    if ($ProdID == "Dungeon Masters Screen"){
        $Price = 29.95;
    }
    if ($ProdID == "Dice Set"){
        $Price = 9.95;
    }
    $sql = "INSERT INTO store_order (customerID, itemsPurchased, price) VALUES ('$SessionID', '$ProdID', '$Price')";
    $result = mysqli_query($conn, $sql);
}

function removeItem(){
    //Removes item from order if it fulfills condition. Limits to removing one so not all instances of the item are removed
    global $conn;
    $ProdID = $_GET['ItemToRemove'];
    $SessionID = $_GET['PHPSESSID'];
    $sql = "DELETE FROM store_order WHERE customerID='".$SessionID."' AND itemsPurchased='".$ProdID."' LIMIT 1";
    $result = mysqli_query($conn, $sql);
}

function emptyOrder(){
    //Empties entire order
    global $conn;
    $SessionID = $_GET['PHPSESSID'];
    $sql = "DELETE FROM store_order WHERE customerID='".$SessionID."' AND datePurchased IS NULL";
    $result = mysqli_query($conn, $sql);
}

function displayOrder(){
    //Queries the order of unpurchased items
    global $conn;
    $total = 0;
    $SessionID = session_id();
    $ScriptName = $_SERVER['PHP_SELF'];
    $sql = "SELECT itemsPurchased, price FROM store_order WHERE customerID='".$SessionID."' AND datePurchased IS NULL";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){   //If the query has at least one line, displays all of them     
        echo "<table width='100%'>";
        echo "<tr><th>Product</th><th>Price</th><th>&nbsp;</th></tr>\n";
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr><td>" . htmlentities($row['itemsPurchased']) . "</td>\n";
            printf("<td class='currency'>$%.2f</td>\n", $row['price']); 
            $ID = $row['itemsPurchased'];
            echo "<td><a href='" . $ScriptName . "?PHPSESSID=$SessionID" . "&ItemToRemove=$ID'>Remove Item</a></td></tr>\n";   //Get call to remove related item       
            //
            //
            $total += $row["price"]; //Adds to total price of order
        }
        echo "<tr><td>------------------------------------------------<td></tr>";
        echo "<tr><td>Subtotal</td>\n";
        printf("<td class='currency'>$%.2f</td>\n", $total); //Displays final price
        echo "<td><a href='" . $ScriptName . "?PHPSESSID=$SessionID" . "&EmptyCart=true'>Empty Cart</a></td></tr>\n"; //Get call to remove all items
        echo "</table>";        
        echo "</br><a href='checkOut.php'>Checkout</a></br>"; //Only displays checkout link if there are objects in cart
    } else {
        echo "<p>Your cart is empty! Go back to the store and select an item!</p>"; //Will display if cart is empty
    }
}

function updateEntries(){ //"buys" the item by updating all items where the date purchased is null
    global $conn;
    $SessionID = session_id();
    $ScriptName = $_SERVER['PHP_SELF'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $time_stamp = date("Y-m-d");
    $sql = "UPDATE store_order SET name='".$name."', email='".$email."', datePurchased='".$time_stamp."' WHERE customerID='".$SessionID."' AND datePurchased IS NULL";
    $result = mysqli_query($conn, $sql);

}

function CheckOut(){    
    $processFlag = true; //Flag that prevents processing from happening if email or name isn't valid
    $name = "";
    $email = "";
        if (empty($_POST["name"])) { //Checks valid name
          echo "Name is required</br>";
          $processFlag = false;
        } else {
          $name = test_input($_POST["name"]);
          // check if name only contains letters and whitespace
          if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            echo "Only letters and white space allowed</br>";
            $processFlag = false;
          }
        }
      
        if (empty($_POST["email"])) { //Checks valid email
          echo "Email is required</br>";
          $processFlag = false;
        } else {
          $email = test_input($_POST["email"]);
          // check if e-mail address is well-formed
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format</br>";
            $processFlag = false;
          }
        }
        
        if ($processFlag == true){ //Displays order similar to displayorder function above, albiet with less info
            global $conn;
            $total = 0;
            $SessionID = session_id();
            $ScriptName = $_SERVER['PHP_SELF'];
            $sql = "SELECT itemsPurchased, price FROM store_order WHERE customerID='".$SessionID."' AND datePurchased IS NULL";
            $result = mysqli_query($conn, $sql);
        
            if (mysqli_num_rows($result) > 0){                
                echo "<h1>Your Receipt</h1>";
                echo "<p><strong>Name: </strong>" . $name . "</p>"; //Prints name for safety
                echo "<p><strong>Email: </strong>" . $email . "</p>"; //Prints email for safety
                echo "<table width='100%'>";
                echo "<tr><th>Product</th><th>Price</th><th>&nbsp;</th></tr>\n";
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr><td>" . htmlentities($row['itemsPurchased']) . "</td>\n";
                    printf("<td class='currency'>$%.2f</td></tr>\n", $row['price']);    
                    //
                    //
                    $total += $row["price"];
                }
                echo "<tr><td>------------------------------------------------<td></tr>";
                echo "<tr><td>Total</td>\n";
                printf("<td class='currency'>$%.2f</td></tr>\n", $total);            
                echo "</table>"; 
                updateEntries(); //Updates the entries to be "purchased"
                echo "<h2>Thank you for shopping with us!</h2>";     //Thanks message  
            } 
        }
        
}

function test_input($data) { //Method to sanitize
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }




?>