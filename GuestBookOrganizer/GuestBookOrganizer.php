<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Guest Book</title>

  </head>

  <body>
      <h1>Guest Book</h1>
    <?php

if (isset($_GET['action'])){
	if ((file_exists("name.txt"))
		&& (filesize("name.txt")
			!=0)){
		$NameArray = file("name.txt");
	switch ($_GET['action']){
		case 'Remove Duplicates' :
            $NameArray = array_unique($NameArray);
            $NameArray = array_values($NameArray);
		break;
		case 'Sort Ascending':
		    sort($NameArray);
        break;
        case 'Display Guest Book':
            foreach ($NameArray as $GuestName){
				echo $GuestName . '<br>';
			}
        break;

	}//end of the switch statement
	if (count($NameArray)>0) {
		$NewNames = implode($NameArray);
		$NameStore = fopen("name.txt", "wb");
		if ($NameStore === false)
			echo "There was an error updating the Name file\n";
		else {
			fwrite($NameStore, $NewNames);
			fclose($NameStore);
		}
	}
	else
		unlink("name.txt");
	}
}

if (isset($_POST['submit'])){
	$NameToAdd = stripslashes($_POST['GuestName']) . "\n";
	$ExistingNames = array();
	if (file_exists("name.txt")
		&& filesize("name.txt")
		>0) {
		$ExistingNames = file("name.txt");
	}
	if (in_array($NameToAdd, $ExistingNames)){
		echo "<p>The name you entered already exists!<br />\n";
		echo "Your name was not added to the guest book.</p>";
	}
	else {
		$NameFile = fopen("name.txt", "ab");
		if ($NameFile === false)
			echo "There was an error saving your message!\n";
		else {
			fwrite($NameFile, $NameToAdd);
			fclose($NameFile);
			echo "Your name has been added to the guest book.\n";
		}
	}
	if ((!file_exists("name.txt"))
		|| (filesize("name.txt")
			==0))
		echo "<p>There are no names in the guest book.</p>\n";
	else {
		$NameArray = file("name.txt");
		echo "<table border=\"1\" width=\"100%\" style=\"background-color:lightgray\">\n";
		foreach ($NameArray as $Name){
			echo "<tr>\n";
			echo "<td>" . htmlentities($Name) . "</td>";
			echo "</tr>\n";
		}
		echo "</table>\n";
	}
}

?>

<p>
<a href="GuestBookOrganizer.php?action=Sort%20Ascending">
	Sort Guest Book</a><br />
<a href="GuestBookOrganizer.php?action=Remove%20Duplicates">
	Remove Duplicate Names</a><br />
<a href="GuestBookOrganizer.php?action=Display%20Guest%20Book">
	Display Guest Book</a><br />
</p>
<form action="GuestBookOrganizer.php" method="post">
<p>Sign The Guest Book</p>
<p>Guest Name: <input type="text" name="GuestName" /></p>
<p><input type="submit" name="submit" value="Add Name To Guest Book" />
<input type="reset" name="reset" value="Reset Name" /></p></form>

  </body>
</html>