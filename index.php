<!DOCTYPE html>
<html lang="en">
<head>
<?php
   session_start();
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hangman Game</title>
    <link rel="stylesheet" href="styles.css">
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
		<?php if(!isset($_SESSION['username'])) { ?>
		<p>You can login <a href = "login.html">here</a></p>
		<?php } else {?>
		<p>Welcome, <?php echo $_SESSION['username']; ?>. You can logout <a href = "logout.php">here.</a></p>
		<?php }?>
        </main>
        <footer>
            <p>Team 6 Web development</p>
        </footer>
    </div>
</body>
</html>
