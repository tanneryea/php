<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
        <meta charset="UTF-8">
		<title>Days Array</title>
		<meta http-equiv="content-type"     
			content="text/html; charset=iso-8859-1" />
	</head>
	<body>
        <?php
        $Days = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
        echo "<p>The days of the week in English are: <br>";
        foreach ($Days as $CurrentDay) {
            echo "$CurrentDay <br>";
        }
        echo "</p>";

        $Days[0] = "Dimanche";
        $Days[1] = "Lundi";
        $Days[2] = "Mardi";
        $Days[3] = "Mercedi";
        $Days[4] = "Jeudi";
        $Days[5] = "Vendredi";
        $Days[6] = "Samedi";

        echo "<p>The days of the week in French are: <br>";
        foreach ($Days as $CurrentDay) {
            echo "$CurrentDay <br>";
        }
        echo "</p>";


        ?>
	</body>
	
</html>