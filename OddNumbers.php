<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Odd Numbers</title>

  </head>

  <body>
    <?php
    $num = 1;

    while ($num < 100){
        if ($num % 2 == 0){
            $num++;
        } else {
            echo "<p>$num</p>";
            $num++;
        }
    }
    ?>





  </body>
</html>