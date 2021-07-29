<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Paycheck</title>
  </head>

  <body>
    <?php

    function displayError($fieldName, $errorMsg){
        global $errorCount;
        echo "Error for \"$fieldName\": $errorMsg<br/>\n";
        ++$errorCount;
    }

    function validateNumbers($data, $fieldName){
        global $errorCount;
        if (empty($data)){
            displayError($fieldName, "This field is required");
            $retval = "";
        } else {
            $retval = trim($data);
            $retval = stripslashes($retval);
            if (!is_numeric($retval)){
                displayError($fieldName, "You must enter a numeric value.");
            }
        }
        return($retval);
    }

    $errorCount = 0;
    $overtimeFlag = FALSE;

    $hoursWorked = validateNumbers($_POST['hours'], "Hours Worked");
    $hourlyWage = validateNumbers($_POST['wage'], "Hourly Wage");

    if ($errorCount>0){
        echo "Please use the \"Back\" button to re-enter the data.<br/>\n";
    } else {
        if ($hoursWorked > 40){
            $overtime = $hoursWorked - 40;
            $hoursWorked -= $overtime;
            $weeklyPay = ($hoursWorked * $hourlyWage) + ($overtime * ($hourlyWage * 1.5));
            $overtimeFlag = TRUE;
        } else {
            $weeklyPay = $hoursWorked * $hourlyWage;
        }

        echo "Your pay for this week is: $" . $weeklyPay . "<br/>\n";
        if ($overtimeFlag) {
            echo "You earned " . $overtime . " hours of overtime.";
        }
        
    }


?>






  </body>
</html>