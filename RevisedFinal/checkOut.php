<?php
//Starts session and loads up php with all processing
session_start();
require_once("methods.php");


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Tanner's Bootleg D&D Emporium - Check Out</title>
    <link rel="icon" href="images/favicon.png" />
  </head>

  <body>

    <h1>Checkout</h1>
    
    <h2>Enter your name and a valid email to check out!</h2>
    <!--Simple form to validate email and name -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Name: <input type="text" name="name"></br>
    Email: <input type="text" name="email"></br>
    <input type="submit">
    </form>

    <?php
    //Checks if post method was active to process checkout
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      CheckOut();
    }
    ?>

    
    <p><a href="viewOrder.php">View Order</a><p>
    <p><a href="index.php">Return to Store</a></p>


  </body>
</html>