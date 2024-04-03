<?php
session_start();
// $_SESSION['Testing'] = "THIS IS A TEST";
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
            background-image: url('background.jpg_large');
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
    <div class="container">
        <header>
            <h1>Hangman Game</h1>
        </header>
        <main>
		<form action = "gamescreen.php" method = "post">
            <div class="buttons-container">
                <button class="play-button" onclick="window.location.href = 'gamescreen.html';">Play</button>
                <div class="difficulty-dropdown">
                    <select class="choose-difficulty" name = "difficulty" id = "difficulty">Choose Difficulty
                    <div class="dropdown-content">
                        <option value = "easy">Easy</option>
                        <option value = "medium">Medium</option>
                        <option value = "hard">Hard</option>
                    </div>
					</select>
                </div>
            </div>
		</form>
        </main>
        
    </div>
</body>
</html>
