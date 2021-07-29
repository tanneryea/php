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

    <title>Tanner's Bootleg D&D Emporium - Order</title>
    <link rel="icon" href="images/favicon.png" />
  </head>

  <body>

    <h1>Shopping Cart</h1> 

    

    <?php
    displayOrder();
    ?>

  </br>
  <a href="index.php">Return to Store</a>

  </body>
</html>