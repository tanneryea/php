<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
        <meta charset="UTF-8">
		<title>Is Even Script</title>
		<meta http-equiv="content-type"     
			content="text/html; charset=iso-8859-1" />
	</head>
	<body>
        <?php
            $num = 256.875;

            echo "The variable contains the data: $num<br>";
            
            if (is_float($num)) {
                $num = round($num, 0);
                echo "The float variable has been rounded to the nearest whole number. <br>";
            }

            if (is_numeric($num) && $num % 2 == 0) {
                echo "$num is a numeral and an even number.";
            }

            if (is_numeric($num) && $num % 2 != 0) {
                echo "$num is a numeral but not an even number.";
            }

            if (is_numeric($num) == false) {
                echo "$num is not a numeral.";
            }
  



        ?>
	</body>
	
</html>