<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correct_answers = $_SESSION['correct_answers'];
    $user_answers = $_POST['answers'];

    $score = 0;

    foreach ($correct_answers as $index => $correct) {
        if (isset($user_answers[$index]) && abs($user_answers[$index] - $correct) < 0.01) { 
            $score++;
        }
    }

    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Quiz Results</title>
    </head>
    <body>
        <div class='result-container'>
            <h1>Quiz Results</h1>
            <p>Your Score: $score / " . count($correct_answers) . "</p>
            <a href='index.php'>Try Again</a>
        </div>
    </body>
    </html>";

    session_destroy();
} else {
    header('Location: index.php');
    exit;
}
