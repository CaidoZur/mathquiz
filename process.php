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

    session_destroy();
} else {
    header('Location: index.php');
    exit;
}
