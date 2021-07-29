<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Two Trains</title>
  </head>

  <body>
        <?php
        $DisplayForm = TRUE;

        if (isset($_POST['Submit'])){
           $Distance = $_POST['Distance'];
           $SpeedA = $_POST['SpeedA'];
           $SpeedB = $_POST['SpeedB'];
            if (is_numeric($Distance) && is_numeric($SpeedA) && is_numeric($SpeedB)){
                if ($Distance > 0 && $SpeedA > 0 && $SpeedB > 0){
                    $DisplayForm = FALSE;
                } else {
                    echo "<p>You need to enter values above 0.</p>\n";
                    $DisplayForm = TRUE;
                }
            } else {
                echo "<p>You need to enter numeric values in all three fields.</p>\n";
                $DisplayForm = TRUE;
            }
        }

        if ($DisplayForm){
            ?>
            <form action="TwoTrains.php" method="post">
            Train A Speed in MPH: <input type="text" name="SpeedA"/> <br/>
            Train B Speed in MPH: <input type="text" name="SpeedB"/> <br/>
            Distance Between Trains In Miles: <input type="text" name="Distance"/> <br/>
            <input type="reset" value="Clear Form"/> &nbsp;
            &nbsp; <input type="submit" name="Submit" value="Send Form"/>
            </form>
            <?php
        } else {
            $DistanceA = (($SpeedA/$SpeedB) * $Distance) / (1 + ($SpeedA / $SpeedB));
            $DistanceB = $Distance - $DistanceA;
            $TimeA = $DistanceA / $SpeedA;
            $TimeB = $DistanceB/$SpeedB;

            echo "<p>Thank you for your input.<p>\n";
            echo "<p>Train A traveled " . round($DistanceA, 2) . " miles in " . round($TimeA, 2) . " hours.<p>\n";
            echo "<p>Train B traveled " . round($DistanceB, 2) . " miles in " . round($TimeB, 2) . " hours.<p>\n";
        }

        ?>


  </body>
</html>