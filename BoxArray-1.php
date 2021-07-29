<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Box Array</title>
  </head>

  <body>
        <?php
        $BoxArray = array(
            array(12, 10, 2.5),
            array(30, 20, 4),
            array(60, 40, 11.5)
        );

        $smallBoxVolume = $BoxArray[0][0] * $BoxArray[0][1] * $BoxArray[0][2];
        $mediumBoxVolume = $BoxArray[1][0] * $BoxArray[1][1] * $BoxArray[1][2];
        $largeBoxVolume = $BoxArray[2][0] * $BoxArray[2][1] * $BoxArray[2][2];

        echo "<p>The volume of the small box is: " . $smallBoxVolume . "<p><br/>";
        echo "<p>The volume of the medium box is: " . $mediumBoxVolume . "<p><br/>";
        echo "<p>The volume of the large box is: " . $largeBoxVolume . "<p><br/>";

        ?>


  </body>
</html>