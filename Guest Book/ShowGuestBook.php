<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="Show Guest Book" content="width=device-width, initial-scale=1" />

    <title>Show Guest Book</title>
  </head>

  <body>

    <?php

    

    echo "<pre>";
    echo readfile("guestbook.txt"); 
    echo "</pre>";

    ?>




  </body>
</html>