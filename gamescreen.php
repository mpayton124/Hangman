<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hangman Game</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php 
	if ($_POST["difficulty"] == "easy") {
			$difficulty = 'easy';
        } else if ($_POST["difficulty"] == "medium") {
			$difficulty = 'medium';
		} else if ($_POST["difficulty"] == "hard") {
			$difficulty = 'hard';
	}
	
	$level = 1;
?> 
    <div class="container">
        <header>
            <h1>Hangman Game</h1>
            <!-- we can replace this with a php function -->
            <!-- maybe also add an option to go back to the main menu -->
        </header>

        <div id="hangman-game">
            <div class="column information">
                <!-- information area -->
                <!-- including level, difficulty, how many guesses left.  -->
                <p>Your Stats:</p>
                <p>Level: <?php print $level ?></p>
				<p>Difficulty: <?php print $_POST["difficulty"] ?></p>
				<p></p>
            </div>

            <div class="column hangman">
                <!-- Hangman area -->
                <img src="images/hangman-0.png" alt="Hangman">
                <!-- if needed we can make it smaller, all of the images are the same size -->

                <div class="word-display">
                    <!-- Word  area -->
                    <p></p>
                </div>
            </div>

            <div class="column guessing">
                <!-- Guess input area -->

                <p>Guessing part</p>
                <!-- to add buttons -->
                <div class="letter-buttons">
                    <button class="letter-button">A</button>
                    <button class="letter-button">B</button>
                    <button class="letter-button">C</button>
                    <button class="letter-button">D</button>
                    <button class="letter-button">E</button>
                    <button class="letter-button">F</button>
                    <button class="letter-button">G</button>
                    <button class="letter-button">H</button>
                    <button class="letter-button">I</button>
                    <button class="letter-button">J</button>
                    <button class="letter-button">K</button>
                    <button class="letter-button">L</button>
                    <button class="letter-button">M</button>
                    <button class="letter-button">N</button>
                    <button class="letter-button">O</button>
                    <button class="letter-button">P</button>
                    <button class="letter-button">Q</button>
                    <button class="letter-button">R</button>
                    <button class="letter-button">S</button>
                    <button class="letter-button">T</button>
                    <button class="letter-button">U</button>
                    <button class="letter-button">V</button>
                    <button class="letter-button">W</button>
                    <button class="letter-button">X</button>
                    <button class="letter-button">Y</button>
                    <button class="letter-button">Z</button>
                </div>

                <p></p>
            </div>

        </div>


        <footer>
            <p>Team 6 Web development</p>
            <!-- we can replace this with a php function -->
        </footer>
    </div>
</body>

</html>