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
if (isset($_POST['difficulty'])) {
    //gets the difficulty from the form and sets it to the session variable
    $_SESSION['difficulty'] = $_POST['difficulty'];
    $difficulty = $_SESSION['difficulty']; //rewrites the difficulty to the session variable easier.
    $_SESSION['level'] = 1;

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
        $level = $_SESSION['level'];
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
</head>
<body>
    <div class="container">
        <header>
            <h1>Hangman Game</h1>
            <!-- we can replace this with a php function  -->
            <!-- maybe also add an option to go back to the main menu -->
        </header>

        <div id="hangman-game">
            <div class="column information">
                <!-- information area -->
                <!-- including level, difficulty, how many guesses left.  -->
                <p>Your Stats:</p>
                <p>Level: <?php print $_SESSION['level'] ?></p>
				<p>Difficulty: <?php print $_SESSION['difficulty'] ?></p>
				<p>Attempts left: <?php print $_SESSION['attempts']?></p>
            </div>

            <div class="column hangman">
                <!-- Hangman area -->
                <img src="<?php echo $hangmanImage; ?>" alt="Hangman">
                <!-- if needed we can make it smaller, all of the images are the same size -->

                <div class="word-display">
                    <!-- Word  area -->
                    <p>Word: <?php echo implode(' ', str_split($_SESSION['wordDisplay'])); ?></p>

                </div>
            </div>

            <div class="column guessing">
                <!-- Guess input area -->

                <p>Guessing part</p>
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
            <p>Team 6 Web development</p>
            <!-- we can replace this with a php function but we dont gotta-->
        </footer>
    </div>
    <?php var_dump($_SESSION); // for debugging REMOVE BEFORE WE FINISH?>  
</body>

</html>