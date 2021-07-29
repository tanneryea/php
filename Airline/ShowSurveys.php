<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Show Guest Book</title>
  </head>

  <body>
    <?php

    $DBConnect = @mysqli_connect("localhost", "root", "");
    if ($DBConnect === FALSE)
        echo "<p>Unable to connect to the database server.</p>"
        . "<p>Error code " . mysqli_errno()
        . ": " . mysqli_error() . "<p>";
    else {
        $DBName = "flightsurvey";
        if (!@mysqli_select_db($DBConnect, $DBName))
            echo "<p>There are no previous surveys!</p>";
        else {
            $TableName = "surveys";
            $SQLstring = "SELECT * FROM $TableName";
            $QueryResult = @mysqli_query($DBConnect, $SQLstring);
            if (mysqli_num_rows($QueryResult) == 0)
                echo "<p>There are no previous surveys!</p>";
            else {
                echo "<p>The following surveys have been conducted:</p>";
                echo "<table width='100%' border='1'>";
                echo "<tr><th>Flight Number</th><th>Flight Date</th><th>Flight Time</th><th>Friendliness</th><th>Luggage</th><th>Comfort</th><th>Cleanliness</th><th>Noise</th></tr>";
                while (($Row = mysqli_fetch_assoc($QueryResult)) != FALSE){
                    echo "<tr><td>{$Row['flight_num']}</td>";                    
                    echo "<td>{$Row['flight_date']}</td>";
                    echo "<td>{$Row['flight_time']}</td>";
                    echo "<td>{$Row['friendliness']}</td>";
                    echo "<td>{$Row['luggage']}</td>";
                    echo "<td>{$Row['comfort']}</td>";
                    echo "<td>{$Row['cleanliness']}</td>";
                    echo "<td>{$Row['noise']}</td></tr>";
                }
            }
            mysqli_free_result($QueryResult);
        }
        mysqli_close($DBConnect);
    }

    ?>




  </body>
</html>