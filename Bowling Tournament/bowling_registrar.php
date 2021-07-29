<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="Bowling Tournament" content="width=device-width, initial-scale=1" />

    <title>Bowling Tournament Registrar</title>
  </head>

  <body>

    <?php
        if (empty($_POST['first_name']) || empty($_POST['last_name'])){
            echo "<p>You must enter your first and last name. Click your browser's Back button to return to the registration page.</p>\n";
        } if (empty($_POST["bowler_age"])) {
            echo "<p>You must enter your age. Click your browser's Back button to return to the registration page.</p>\n";
        } if (empty($_POST["bowler_average"])) {
            echo "<p>You must enter your average. Click your browser's Back button to return to the registration page.</p>\n";
        } else {
            $BowlerFirstName = addslashes($_POST['first_name']);
            $BowlerLastName = addslashes($_POST['last_name']);
            $BowlerAge = addslashes($_POST['bowler_age']);
            $BowlerAverage = addslashes($_POST['bowler_average']);
            $NewBowlerEntry = "$BowlerLastName, $BowlerFirstName, $BowlerAge, $BowlerAverage\r\n";
            $BowlerRegistrar = "bowling_registrar.txt";
            chmod($BowlerRegistrar, 0777);
            
            if (file_put_contents($BowlerRegistrar, $NewBowlerEntry, FILE_APPEND) > 0) {
                echo "<p>" . stripslashes($_POST['first_name']) . " " . stripslashes($_POST['last_name']) . " has been registered to the bowling tournmanet. Good luck!";
            } else {
                echo "<p>There was an issue registering you to the tournament. Please try again.";
            }
        }

    ?>


  </body>
</html>