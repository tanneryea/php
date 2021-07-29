<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="Dungeons & Dragons Quiz" content="width=device-width, initial-scale=1" />

    <title>Dungeons & Dragons Quiz</title>
  </head>

  <body>

  <?php
    //Declares all needed variables
    $quizNumber = array("q1", "q2", "q3", "q4", "q5", "q6", "q7", "q8", "q9", "q10");
    $miscError = false;
    $unanswerederror = false;
    $correctQs = 0;
    $numberBlank = 0;  
    $msg = "";
    $answers = file("answers.txt", FILE_IGNORE_NEW_LINES); //Reads answers from file
    $email;
    



  foreach ($quizNumber as $question){ //Checks to see how many questions are blank, then throws error flag
    if (empty($_POST[$question])) {
        $numberBlank++;
        $unanswerederror = true;
    }
  } 
  
  //Error processing depending on issue, throws an error
  if ($unanswerederror){ //Only displays if questions are unanswered
      echo "You did not answer " . $numberBlank . " question(s).<br>";
  } if (empty($_POST["quiz_name"])) {
      echo "You must enter a name.<br>";
      $miscError = true;
  } if (empty($_POST["email"])) {
      echo "You must enter an email address.<br>";
      $miscError = true;
  } if (!empty($_POST["email"])){
        $email = test_input($_POST["email"]); //Sanitizes email input
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){ //Quick email validation
            echo "You did not enter a valid email address.<br>";
            $miscError = true;
    }
  } 
  //Redisplays form if there are issues
  if ($unanswerederror || $miscError){
      echo "Please resubmit the form below with all fields filled in.<br>";
      redisplay_form();
  }
  
  //Reads answers into array and begins constructing email message
  if (!$unanswerederror && !$miscError){
      $msg .= "Thank you for taking our quiz " . $_POST["quiz_name"] . "! Here are your results:\n\n";
      $responses = array("Question 1"=>$_POST["q1"],"Question 2"=>$_POST["q2"],"Question 3"=>$_POST["q3"],"Question 4"=>$_POST["q4"],"Question 5"=>$_POST["q5"],
      "Question 6"=>$_POST["q6"],"Question 7"=>$_POST["q7"],"Question 8"=>$_POST["q8"],"Question 9"=>$_POST["q9"],"Question 10"=>$_POST["q10"]);

        foreach ($quizNumber as $question){ //Switch statement to validate each question. Writes result into email message
            switch ($question){
                case "q1":
                    echo "Question 1: Which of the following is NOT an official D&D setting? <br>";
                    echo "Your response: " . $_POST["q1"] . "\t";
                    $msg .= "Question 1.\nYour Answer: " . $responses["Question 1"] . "\n";
                    if ($responses["Question 1"] == $answers[0]) {
                        echo "&check;<br>";
                        $correctQs++;
                    } else {
                        echo "&cross;<br>";
                        $msg .= "Correct Answer: Glorantha\n";
                    }
                    echo "<br>";
                break;
                case "q2":
                    echo "Question 2: What is another name for dark elves? <br>";
                    echo "Your response: " . $responses["Question 2"] . "\t";
                    $msg .= "Question 2.\nYour Answer: " . $responses["Question 2"] . "\n";
                    if ($responses["Question 2"] == $answers[1]) {
                        echo "&check;<br>";
                        $correctQs++;
                    } else {
                        echo "&cross;<br>";
                        $msg .= "Correct Answer: Drow\n";
                    }
                    echo "<br>";
                break;
                case "q3":
                    echo "Question 3: By 5th Edition rules, you can critically succeed on skill checks. <br>";
                    echo "Your response: " . $responses["Question 3"] . "\t";
                    $msg .= "Question 3.\nYour Answer: " . $responses["Question 3"] . "\n";
                    if ($responses["Question 3"] == $answers[2]) {
                        echo "&check;<br>";
                        $correctQs++;
                    } else {
                        echo "&cross;<br>";
                        $msg .= "Correct Answer: False\n";
                    }
                    echo "<br>";
                break;
                case "q4":
                    echo "Question 4: Which player class from the 5th Edition Player's Handbook is the most recent addition? <br>";
                    echo "Your response: " . $responses["Question 4"] . "\t";
                    $msg .= "Question 4.\nYour Answer: " . $responses["Question 4"] . "\n";
                    if ($responses["Question 4"] == $answers[3]) {
                        echo "&check;<br>";
                        $correctQs++;
                    } else {
                        echo "&cross;<br>";
                        $msg .= "Correct Answer: Warlock\n";
                    }
                    echo "<br>";
                break;
                case "q5":
                    echo "Question 5: The name of Drizzt Do'Urden's pet panther is ___________ <br>";
                    echo "Your response: " . $responses["Question 5"]  . "\t";
                    $msg .= "Question 5.\nYour Answer: " . $responses["Question 5"] . "\n";
                    if (ucfirst($responses["Question 5"]) == $answers[4]) {
                        echo "&check;<br>";
                        $correctQs++;
                    } else {
                        echo "&cross;<br>";
                        $msg .= "Correct Answer: Guenhywvar\n";
                    }
                    echo "<br>";
                break;
                case "q6":
                    echo "Question 6: Which plane is home to the archons? <br>";
                    echo "Your response: " . $responses["Question 6"] . "\t";
                    $msg .= "Question 6.\nYour Answer: " . $responses["Question 6"] . "\n";
                    if ($responses["Question 6"] == $answers[5]) {
                        echo "&check;<br>";
                        $correctQs++;
                    } else {
                        echo "&cross;<br>";
                        $msg .= "Correct Answer: Mount Celestia\n";
                    }
                    echo "<br>";
                break;
                case "q7":
                    echo "Question 7: The original D&D books were published in 1974. <br>";
                    echo "Your response: " . $responses["Question 7"] . "\t";
                    $msg .= "Question 7.\nYour Answer: " . $responses["Question 7"] . "\n";
                    if ($responses["Question 7"] == $answers[6]) {
                        echo "&check;<br>";
                        $correctQs++;
                    } else {
                        echo "&cross;<br>";
                        $msg .= "Correct Answer: True\n";
                    }
                    echo "<br>";
                break;
                case "q8":
                    echo "Question 8: Count Strahd Von Zarovich rules over the region known as ___________. <br>";
                    echo "Your response: " . $responses["Question 8"] . "\t";
                    $msg .= "Question 8.\nYour Answer: " . $responses["Question 8"] . "\n";
                    if (ucfirst($responses["Question 8"]) == $answers[7]) {
                        echo "&check;<br>";
                        $correctQs++;
                    } else {
                        echo "&cross;<br>";
                        $msg .= "Correct Answer: Barovia\n";
                    }
                    echo "<br>";
                break;
                case "q9":
                    echo "Question 9: Fireball is most commonly a 3rd Level spell. <br>";
                    echo "Your response: " . $responses["Question 9"] . "\t";
                    $msg .= "Question 9.\nYour Answer: " . $responses["Question 9"] . "\n";
                    if ($responses["Question 9"] == $answers[8]) {
                        echo "&check;<br>";
                        $correctQs++;
                    } else {
                        echo "&cross;<br>";
                        $msg .= "Correct Answer: True\n";
                    }
                    echo "<br>";
                break;
                case "q10":
                    echo "Question 10: What do illithids eat for sustenance? <br>";
                    echo "Your response: " . $responses["Question 10"] . "\t";
                    $msg .= "Question 10.\nYour Answer: " . $responses["Question 10"] . "\n";
                    if ($responses["Question 10"] == $answers[9]) {
                        echo "&check;<br>";
                        $correctQs++;
                    } else {
                        echo "&cross;<br>";
                        $msg .= "Correct Answer: Brains\n";
                    }
                    echo "<br>";
                break;
            }
        }
        echo "You answered " . $correctQs . " out of 10 correct for a score of " . (($correctQs/10)*100) . "%"; //Displays final score

        switch($correctQs){
            case 0:
                echo "<br/>You're a Giant Rat!";
            break;
            case 1:
                echo "<br/>You're an Orc!";
            break;
            case 2:
                echo "<br/>You're a Zombie!";
            break;
            case 3:
                echo "<br/>You're a Ghoul!";
            break;
            case 4:
                echo "<br/>You're an Ogre!";
            break;
            case 5:
                echo "<br/>You're a Centaur!";
            break;
            case 6:
                echo "<br/>You're a Gargoyle!";
            break;
            case 7:
                echo "<br/>You're a Cockatrice!";
            break;
            case 8:
                echo "<br/>You're a Manticore!";
            break;
            case 9:
                echo "<br/>You're a Treant!";
            break;
            case 10:
                echo "<br/>You're a Red Dragon!";
            break;

        }

        $msg .= "\n\nYour total score was " . (($correctQs/10)*100); //Displays percent correct

        mail($email, "Dungeons & Dragons Quiz Results", $msg); //Sends email
  }
  

  function test_input($data) { //Quick email sanitization function
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function redisplay_form(){ //Sticky Form. Only displays checked radio buttons if previously pressed, otherwise error would occur
    ?>
        <h1>Dungeons & Dragons Quiz</h1>
        <p>All questions must be answered to grade quiz.</p>
        <form action="quiz.php" method="POST">
        <fieldset>
            <legend>Question 1:</legend>
            <h3>Which of the following is NOT an official D&D setting?</h3>
            <input type="radio" id="dark_sun" name="q1" value="Dark Sun" <?php if(isset($_POST["q1"]) && ($_POST["q1"]) == "Dark Sun") echo 'checked';?>>            
            <label for="dark_sun">Dark Sun</label><br>
            <input type="radio" id="forgotten_realms" name="q1" value="Forgotten Realms" <?php if(isset($_POST["q1"]) && ($_POST["q1"]) == "Forgotten Realms") echo 'checked';?>>            
            <label for="forgotten_realms">Forgotten Realms</label><br>
            <input type="radio" id="eberron" name="q1" value="Eberron" <?php if(isset($_POST["q1"]) && ($_POST["q1"]) == "Eberron") echo 'checked';?>>            
            <label for="eberron">Eberron</label><br>
            <input type="radio" id="glorantha" name="q1" value="Glorantha" <?php if(isset($_POST["q1"]) && ($_POST["q1"]) == "Glorantha") echo 'checked';?>>            
            <label for="glorantha">Glorantha</label><br>
        </fieldset>
        <fieldset>
            <legend>Question 2:</legend>
            <h3>What is another name for dark elves?</h3>
            <input type="radio" id="drow" name="q2" value="Drow" <?php if(isset($_POST["q2"]) && ($_POST["q2"]) == "Drow") echo 'checked';?>>            
            <label for="drow">Drow</label><br>
            <input type="radio" id="svirfneblin" name="q2" value="Svirfneblin" <?php if(isset($_POST["q2"]) && ($_POST["q2"]) == "Svirfneblin") echo 'checked';?>>            
            <label for="svirfneblin">Svirfneblin</label><br>
            <input type="radio" id="duergar" name="q2" value="Duergar" <?php if(isset($_POST["q2"]) && ($_POST["q2"]) == "Duergar") echo 'checked';?>>            
            <label for="duergar">Duergar</label><br>
            <input type="radio" id="derro" name="q2" value="Derro" <?php if(isset($_POST["q2"]) && ($_POST["q2"]) == "Derro") echo 'checked';?>>            
            <label for="derro">Derro</label><br>
        </fieldset>
        <fieldset>
            <legend>Question 3:</legend>
            <h3>By 5th Edition rules, you can critically succeed on skill checks.</h3>
            <input type="radio" id="true" name="q3" value="True" <?php if(isset($_POST["q3"]) && ($_POST["q3"]) == "True") echo 'checked';?>>            
            <label for="true">True</label><br>
            <input type="radio" id="false" name="q3" value="False" <?php if(isset($_POST["q3"]) && ($_POST["q3"]) == "False") echo 'checked';?>>            
            <label for="false">False</label><br>
        </fieldset>
        <fieldset>
            <legend>Question 4:</legend>
            <h3>Which player class from the 5th Edition Player's Handbook is the most recent addition?</h3>
            <input type="radio" id="monk" name="q4" value="Monk" <?php if(isset($_POST["q4"]) && ($_POST["q4"]) == "Monk") echo 'checked';?>>            
            <label for="monk">Monk</label><br>
            <input type="radio" id="sorcerer" name="q4" value="Sorcerer" <?php if(isset($_POST["q4"]) && ($_POST["q4"]) == "Sorcerer") echo 'checked';?>>            
            <label for="sorcerer">Sorcerer</label><br>
            <input type="radio" id="warlock" name="q4" value="Warlock" <?php if(isset($_POST["q4"]) && ($_POST["q4"]) == "Warlock") echo 'checked';?>>            
            <label for="warlock">Warlock</label><br>
            <input type="radio" id="druid" name="q4" value="Druid" <?php if(isset($_POST["q4"]) && ($_POST["q4"]) == "Druid") echo 'checked';?>>            
            <label for="druid">Druid</label><br>
        </fieldset>
        <fieldset>
            <legend>Question 5:</legend>
            <h3>The name of Drizzt Do'Urden's pet panther is ___________</h3>
            <input type="text" id="panther" name="q5" value="<?php if(isset($_POST["q5"])) echo $_POST["q5"];?>">
        </fieldset>
        <fieldset>
            <legend>Question 6:</legend>
            <h3>Which plane is home to the archons?</h3>
            <input type="radio" id="mechanus" name="q6" value="Mechanus" <?php if(isset($_POST["q6"]) && ($_POST["q6"]) == "Mechanus") echo 'checked';?>>
            <label for="mechanus">Mechanus</label><br>
            <input type="radio" id="mount_celestia" name="q6" value="Mount Celestia" <?php if(isset($_POST["q6"]) && ($_POST["q6"]) == "Mount Celestia") echo 'checked';?>>
            <label for="mount_celestia">Mount Celestia</label><br>
            <input type="radio" id="the_abyss" name="q6" value="The Abyss" <?php if(isset($_POST["q6"]) && ($_POST["q6"]) == "The Abyss") echo 'checked';?>>
            <label for="the_abyss">The Abyss</label><br>
            <input type="radio" id="feywild" name="q6" value="Feywild" <?php if(isset($_POST["q6"]) && ($_POST["q6"]) == "Feywild") echo 'checked';?>>
            <label for="feywild">Feywild</label><br>
        </fieldset>
        <fieldset>
            <legend>Question 7:</legend>
            <h3>The original D&D books were published in 1974.</h3>
            <input type="radio" id="true" name="q7" value="True" <?php if(isset($_POST["q7"]) && ($_POST["q7"]) == "True") echo 'checked';?>>
            <label for="true">True</label><br>
            <input type="radio" id="false" name="q7" value="False" <?php if(isset($_POST["q7"]) && ($_POST["q7"]) == "False") echo 'checked';?>>
            <label for="false">False</label><br>
        </fieldset>
        <fieldset>
            <legend>Question 8:</legend>
            <h3>Count Strahd Von Zarovich rules over the region known as ___________.</h3>
            <input type="text" id="region" name="q8" value="<?php if(isset($_POST["q8"])) echo $_POST["q8"];?>">
        </fieldset>
        <fieldset>
            <legend>Question 9:</legend>
            <h3>Fireball is most commonly a 3rd Level spell.</h3>
            <input type="radio" id="true" name="q9" value="True" <?php if(isset($_POST["q9"]) && ($_POST["q9"]) == "True") echo 'checked';?>>
            <label for="true">True</label><br>
            <input type="radio" id="false" name="q9" value="False" <?php if(isset($_POST["q9"]) && ($_POST["q9"]) == "False") echo 'checked';?>>
            <label for="false">False</label><br>
        </fieldset>
        <fieldset>
            <legend>Question 10:</legend>
            <h3>What do illithids eat for sustenance?</h3>
            <input type="radio" id="blood" name="q10" value="Blood" <?php if(isset($_POST["q10"]) && ($_POST["q10"]) == "Blood") echo 'checked';?>>
            <label for="blood">Blood</label><br>
            <input type="radio" id="souls" name="q10" value="Souls" <?php if(isset($_POST["q10"]) && ($_POST["q10"]) == "Souls") echo 'checked';?>>
            <label for="souls">Souls</label><br>
            <input type="radio" id="brains" name="q10" value="Brains" <?php if(isset($_POST["q10"]) && ($_POST["q10"]) == "Brains") echo 'checked';?>>
            <label for="brains">Brains</label><br>
            <input type="radio" id="flesh" name="q10" value="Flesh" <?php if(isset($_POST["q10"]) && ($_POST["q10"]) == "Flesh") echo 'checked';?>>
            <label for="flesh">Flesh</label><br>
        </fieldset>
        <p>Name: <input type="text" name="quiz_name" value="<?php echo $_POST["quiz_name"];?>"/> * Name is required.</p>
        <p>Email: <input type="text" name="email" value="<?php echo $_POST["email"];?>"/> * Email is required</p>
        <button type="submit" value="Submit">Submit</button>
        <button type="reset" value="Reset">Reset</button>
    </form>
    <?php
}

?>


  </body>
</html>