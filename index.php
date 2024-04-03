<?php
session_start();
var_dump($_SESSION);
// $_SESSION['Testing'] = "THIS IS A TEST";

$_SESSION['username'] = 'TestUser';

//flush
unset($_SESSION['progress']['level']);
unset($_SESSION['progress']['difficulty']);

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
        <div id="leaderboard">
            <h2>Current leaderboard</h2>
            <?php
                $leaderboard = [];
                $userPoints=0;
                $fileContents = file_get_contents('leaderboard_list.txt');
                $lines = explode(PHP_EOL, $fileContents);
                foreach($lines as $line) {
                    $parts = explode(",", $line);
                    $username = trim($parts[0]);
                    $points = trim($parts[1]);
                    $leaderboard[$username] = $points;
                    if ($username == $_SESSION['username']) {
                        $userPoints = $points;
                    }
                }

                arsort($leaderboard);//sorts the arrary desc by points
                

                echo "<table>";
                echo "<tr><th>Username</th><th>Points</th></tr>";

                $counter = 0;
                $user_found = false;
                foreach ($leaderboard as $username => $points) {
                    if ($username == $_SESSION['username']){
                        echo "<tr style='background-color:#F7D488'><td>$username</td><td>$points</td></tr>";
                        $user_found = true;
                    }else{
                        echo "<tr><td>$username</td><td>$points</td></tr>";
                    }
                    $counter++;
                    if ($counter >= 5) { // display top 5 users
                        break;
                    }
                }
                if (!$user_found){
                    echo "<tr><td>...</td><td>...</td></tr>";
                    echo "<tr style='background-color:#F7D488'><td>".$_SESSION['username']."</td><td>".$userPoints."</td></tr>";
                }
               

                echo "</table>";

            ?>
        </div>
        
        </main>
        
    </div>
</body>
</html>
