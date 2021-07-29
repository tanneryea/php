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

    <title>Tanner's Bootleg D&D Emporium</title>
    <link rel="icon" href="images/favicon.png" />
  </head>

  <body>

    <h1>Tanner's Bootleg D&D Emporium</h1>
    <h2>Selling Semi-Quality D&D Books I Found Behind The Panda Express On Davis</h2>
    <p>Welcome to the store! Select some items from below to start playing D&D - don't tell Wizards!</p>
    
    <!--Table below has links to make GET calls to add items to "cart"-->
    <table width='100%'>
      <tr>
        <th>Product</th>
        <th>Description</th>
        <th>Price</th>
        <th>&nbsp;</th>
      </tr>
      <tr>
          <td>Players Handbook</td>
          <td>All you need to create characters to begin playing in the worlds of Dungeons & Dragons</td>
          <td>$49.95</td>    
          <td><a href='<?php echo $_SERVER['PHP_SELF']. "?PHPSESSID=" . session_id() . "&ItemToAdd=Players Handbook"?>'>Add Item</a>
      <tr>
      <tr>
          <td>Dungeon Masters Guide</td>
          <td>A must-have for Dungeon Masters, offering advice on running the world's greatest roleplaying game</td>
          <td>$49.95</td>       
          <td><a href='<?php echo $_SERVER['PHP_SELF']. "?PHPSESSID=" . session_id() . "&ItemToAdd=Dungeon Masters Guide"?>'>Add Item</a>
      <tr>
      <tr>
          <td>Monster Manual</td>
          <td>Hundreds of fantastic enemies to populate your dungeons with, from goblins to dragons to even demons</td>
          <td>$49.95</td>       
          <td><a href='<?php echo $_SERVER['PHP_SELF']. "?PHPSESSID=" . session_id() . "&ItemToAdd=Monster Manual"?>'>Add Item</a>
      <tr>
      <tr>
          <td>Dungeon Masters Screen</td>
          <td>Perfect for Dungeon Masters, the screen provides important rules for easy reference and a blocker to hide your notes</td>  
          <td>$29.95</td>     
          <td><a href='<?php echo $_SERVER['PHP_SELF']. "?PHPSESSID=" . session_id() . "&ItemToAdd=Dungeon Masters Screen"?>'>Add Item</a>
      <tr>
      <tr>
          <td>Dice Set</td>
          <td>A set of 7 polyhedral die required for most roleplaying games. Includes: d4, d6, d8, d10, d12, d20 and d00</td>    
          <td>$9.95</td>   
          <td><a href='<?php echo $_SERVER['PHP_SELF'] . "?PHPSESSID=" . session_id() . "&ItemToAdd=Dice Set"?>'>Add Item</a>
      <tr>
    </table>

    <p><a href="viewOrder.php">View Order</a><p>
    

    <?php
    //Displays when order is successfully added
    if (!empty($_GET['ItemToAdd'])){
        echo "<p>" . $_GET['ItemToAdd'] . " successfully added to order!<p>";
    }
    ?>

  </body>
</html>