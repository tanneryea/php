<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Airline Survey</title>
  </head>

  <body>
    <?php

if (empty($_POST['flight_num']) || empty($_POST['date']) || empty($_POST['time']))     
    echo "<p>You must enter a flight number, date and time! Click your browser's Back button to           
        return to the Survey form.</p>";
    else {
        $DBConnect = @mysqli_connect("localhost", "root", "");
        if ($DBConnect === FALSE)
            echo "<p>Unable to connect to the database server.</p>"              
            . "<p>Error code " . mysqli_errno()               
            . ": " . mysqli_error() . "</p>";
        else {
            $DBName = "flightsurvey";
            if (!@mysqli_select_db($DBConnect, $DBName)){
                $SQLstring = "CREATE DATABASE $DBName";
                $QueryResult = @mysqli_query($DBConnect, $SQLstring);
                if ($QueryResult === FALSE)
                    echo "<p>Unable to execute the query.</p>"
                    . "<p>Error code " . mysqli_errno($DBConnect). 
                    ": " . mysqli_error($DBConnect) . "</p>";
                else
                    echo "<p>You are the first survey participant!</p>";                
            }
            mysqli_select_db($DBConnect, $DBName);
            $TableName = "surveys";   
            $SQLstring = "SHOW TABLES LIKE '$TableName'";   
            $QueryResult = @mysqli_query($DBConnect, $SQLstring);   
            if (!$QueryResult || mysqli_num_rows($QueryResult) == 0) {        
                $SQLstring = "CREATE TABLE $TableName         
                (countID SMALLINT        
                NOT NULL AUTO_INCREMENT PRIMARY KEY,        
                flight_num VARCHAR(40), flight_date VARCHAR(40),
                flight_time VARCHAR(40), friendliness VARCHAR(40),
                luggage VARCHAR(40), comfort VARCHAR(40),
                cleanliness VARCHAR(40), noise VARCHAR(40))";        
                $QueryResult = @mysqli_query($DBConnect, $SQLstring);        
                if ($QueryResult === FALSE)             
                    echo "<p>Unable to create the table.</p>"                
                    . "<p>Error code " . mysqli_errno($DBConnect)                
                    . ": " . mysqli_error($DBConnect) . "</p>";
            }
            $FlightNum = stripslashes($_POST['flight_num']);
            $FlightDate = stripslashes($_POST['date']);
            $FlightTime = stripslashes($_POST['time']);
            $Friendliness = stripslashes($_POST['friendliness']);
            $Luggage = stripslashes($_POST['luggage']);
            $Comfort = stripslashes($_POST['comfort']);
            $Cleanliness = stripslashes($_POST['cleanliness']);
            $Noise = stripslashes($_POST['noise']);

            $SQLstring = "INSERT INTO $TableName VALUES(NULL, '$FlightNum','$FlightDate', '$FlightTime', '$Friendliness', '$Luggage', '$Comfort', '$Cleanliness', '$Noise')";               
            $QueryResult = @mysqli_query($DBConnect, $SQLstring);               
            if ($QueryResult === FALSE)
                echo "<p>Unable to execute the query.</p>"                       
                . "<p>Error code " . mysqli_errno($DBConnect)                       
                . ": " . mysqli_error($DBConnect) . "</p>";               
            else
                echo "<h1>Thank you for taking our survey!</h1>";
            mysqli_close($DBConnect);

        }  
 
    }
    

    ?>




  </body>
</html>