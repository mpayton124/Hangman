<?php
session_start();
// var_dump($_SESSION);

include 'words.php';

	
	$level = 1; 

    function processGuess($guess, $word, $wordDisplay) {
        $response = "";
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
            $response = "Good guess! Word: " . $_SESSION['wordDisplay'];
            } 
        
    }else {
        $_SESSION['attempts']--;
        if ($_SESSION['attempts'] == 0) {
            $_SESSION['win'] = false;
            // Redirect to another page - works as long as there is no output before this
            header("Location: loss.php");
            exit();
        }
        // $response = "Sorry, '$guess' is not in the word.";
        // return $response;
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

    // choosing the random word list based on the difficulty
    $wordList = [];
    if ($difficulty  == "easy") {
        $wordList = $words_easy;
    } elseif ($difficulty  == "medium") {
        $wordList = $words_med;
    } elseif ($difficulty  == "hard") {
        $wordList = $words_hard;
    }
    $_SESSION['word'] = strtoupper($wordList[array_rand($wordList)]);
    $_SESSION['wordDisplay'] = str_repeat("_", strlen($_SESSION['word'])); //making the word display start with all underscores
 
    // reseting  the remaining attempts to 6 i think thats how many they have im not counting
    $_SESSION['attempts'] = 6;
        $word = $_SESSION['word'];
        $level = $_SESSION['level'];
}



    if (isset($_POST['guess'])) {
        processGuess($_POST['guess'], $_SESSION['word'], str_split($_SESSION['wordDisplay']));
        // echo "<script>alert('$response');</script>";
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
                <!-- to add buttons -->
                <form action="gamescreen.php" method="post">
                    <div class="letter-buttons">
                        <button class="letter-button" name="guess" value="A">A</button>
                        <button class="letter-button" name="guess" value="B">B</button>
                        <button class="letter-button" name="guess" value="C">C</button>
                        <button class="letter-button" name="guess" value="D">D</button>
                        <button class="letter-button" name="guess" value="E">E</button>
                        <button class="letter-button" name="guess" value="F">F</button>
                        <button class="letter-button" name="guess" value="G">G</button>
                        <button class="letter-button" name="guess" value="H">H</button>
                        <button class="letter-button" name="guess" value="I">I</button>
                        <button class="letter-button" name="guess" value="J">J</button>
                        <button class="letter-button" name="guess" value="K">K</button>
                        <button class="letter-button" name="guess" value="L">L</button>
                        <button class="letter-button" name="guess" value="M">M</button>
                        <button class="letter-button" name="guess" value="N">N</button>
                        <button class="letter-button" name="guess" value="O">O</button>
                        <button class="letter-button" name="guess" value="P">P</button>
                        <button class="letter-button" name="guess" value="Q">Q</button>
                        <button class="letter-button" name="guess" value="R">R</button>
                        <button class="letter-button" name="guess" value="S">S</button>
                        <button class="letter-button" name="guess" value="T">T</button>
                        <button class="letter-button" name="guess" value="U">U</button>
                        <button class="letter-button" name="guess" value="V">V</button>
                        <button class="letter-button" name="guess" value="W">W</button>
                        <button class="letter-button" name="guess" value="X">X</button>
                        <button class="letter-button" name="guess" value="Y">Y</button>
                        <button class="letter-button" name="guess" value="Z">Z</button>
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
    <?php var_dump($_SESSION); // for debugging?>  
</body>

</html>