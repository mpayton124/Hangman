<?php
session_start();
// var_dump($_SESSION);

include 'words.php';

	
	$level = 1; 

    function processGuess($guess, $word, $wordDisplay) {
        //adding the guessed letter to guessed letters
        $_SESSION['guessedLetters'][] = $guess;
        //checking if the guess is correct
        
        if (strpos($word, $guess) !== false) {
            /// updating the word display to show the correct guess
            $wordArray = str_split($word);
            foreach ($wordArray as $key => $letter) {
                if ($letter == $guess) {
                    $wordDisplay[$key] = $guess;
                }
            }

            
            $_SESSION['wordDisplay'] = implode($wordDisplay);
            if ($_SESSION['wordDisplay'] == $_SESSION['word']) {
                $_SESSION['win'] = true;
            // Redirect to another page - works as long as there is no output before this
                header("Location: win.php");
                exit();
            }else{
           //want to change buttons to be disabled if they have already been guessed - here is correct, make them green
            } 
        
    }else {
        //if the guess is incorrect, decrement the attempts, button pressed should be disabled and turned red.
        $_SESSION['attempts']--;
        if ($_SESSION['attempts'] == 0) {
            $_SESSION['win'] = false;
            // Redirect to another page - works as long as there is no output before this
            header("Location: loss.php");
            exit();
        }
    }
}
    


    // on initial load, set the difficulty to what is inputted, and set the word to a random word from the list. 
//this is changed to stay in the session so that the word does not change every time the page is refreshed from guessing.


//when posting difficulty (from main menu and transition to other words)
if (isset($_POST['difficulty_path'])){
    unset($_SESSION['progress']['level']);
}

if (!isset($_SESSION['progress']['totalwins'])) {
        $_SESSION['progress']['totalwins'] = 0;
    }

if (isset($_POST['difficulty']) or isset($_POST['difficulty_path']) or isset($_POST['difficulty_path_same'])) {
    //gets the difficulty from the form and sets it to the session variable
    //the reason theres so many ifs is because we have to check if the difficulty is being set from the main menu or from the win screen
    //and if they are going to the same difficulty or go to the next one.
    if (isset($_POST['difficulty_path'])){
        $_SESSION['progress']['difficulty'] = $_POST['difficulty_path'];
    }else if (isset($_POST['difficulty_path_same'])){
        $_SESSION['progress']['difficulty'] = $_POST['difficulty_path_same'];
    }else{
        $_SESSION['progress']['difficulty'] = $_POST['difficulty'];
    }
   
    
    if (isset($_SESSION['progress']['level'])) {
        $_SESSION['progress']['level']++;
    } else {
        $_SESSION['progress']['level'] = 1;
    }
    // $_SESSION['progress']['level'] = 1;
    
    $difficulty = $_SESSION['progress']['difficulty'];

    $_SESSION['guessedLetters'] = [];

    // choosing the random word list based on the difficulty
    $wordList = [];
    if ($difficulty  == "easy") {
        $wordList = $words_easy;
    } elseif ($difficulty  == "medium") {
        $wordList = $words_med;
    } elseif ($difficulty  == "hard") {
        $wordList = $words_hard;
    }
    $_SESSION['word'] = ($wordList[array_rand($wordList)]);
    $_SESSION['wordDisplay'] = str_repeat("_", strlen($_SESSION['word'])); //making the word display start with all underscores
 
    // making the remaining attempts to 6 (syncs with the amt of images we have for hangman)
    $_SESSION['attempts'] = 6;
        $word = $_SESSION['word'];
        // $level = $_SESSION['level'];
}



    if (isset($_POST['guess'])) {
        $guess = $_POST['guess'];
        

        processGuess($guess, $_SESSION['word'], str_split($_SESSION['wordDisplay']));
    }

    $hangmanImage = "images/hangman-" . (6 - $_SESSION['attempts']) . ".png";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hangman Game</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            /* Set a light background color */
            background-image: url('background.jpg');
            /* Add background image */
            background-size: cover;
            /* Cover the entire viewport 
            background-position: center;*/
            /* Center the background image */
            background-repeat: no-repeat;
            /* Do not repeat the background image */
        }
    </style>
</head>
<body>
    <div class="container game-screen-container">
        <header>
            <h1>Hangman Game</h1>
            <!-- we can replace this with a php function  -->
            <!-- maybe also add an option to go back to the main menu -->
        </header>

        <div id="hangman-game">
            <div class="column information">
                <!-- information area -->
                <!-- including level, difficulty, how many guesses left.  -->
                <h2>Your Stats:</h2>
                <p><span class="bold">Level</span>: <?php print $_SESSION['progress']['level'] ?></p>
				<p><span class="bold">Difficulty</span>: <?php print $_SESSION['progress']['difficulty'] ?></p>
				<p><span class="bold">Attempts left</span>: <?php print $_SESSION['attempts']?></p>
            </div>

            <div class="column hangman">
                <div class="word-display">
                    <!-- Word  area -->
                    <p>Word: <?php echo implode(' ', str_split($_SESSION['wordDisplay'])); ?></p>

                </div>
                <!-- Hangman area -->
                <img src="<?php echo $hangmanImage; ?>" alt="Hangman">
                <!-- if needed we can make it smaller, all of the images are the same size -->

                
            </div>

            <div class="column guessing">
                <!-- Guess input area -->

                <h2>Guessing</h2>
                <form action="gamescreen.php" method="post">
                <div class="letter-buttons">
                    <?php
                    $guessedLetters =  $_SESSION['guessedLetters'] ;
                    $alphabet = range('A', 'Z');
                    
                    foreach ($alphabet as $letter) {
                        if (in_array($letter, $guessedLetters)) {
                            $class = in_array($letter, str_split($_SESSION['word'])) ? 'correct-guess' : 'wrong-guess';
                            $disabled = 'disabled';
                        } else {
                            $disabled = '';
                            $class = '';
                        }
                        echo "<button class='letter-button $class' name='guess' value='$letter' $disabled >$letter</button>";
                    }
                    ?>
                </div>
            </form>

                <p></p>
            </div>

        </div>


        <footer>
            <p style="color:white">Team 6 Web development</p>
            <!-- we can replace this with a php function but we dont gotta-->
        </footer>
    </div>
    <?php var_dump($_SESSION); // for debugging REMOVE BEFORE WE FINISH?>  
</body>

</html>