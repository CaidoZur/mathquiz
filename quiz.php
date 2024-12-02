<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $difficulty = $_POST['difficulty'];
    $operator = $_POST['operator'];

    $range = [
        'easy' => [1, 10],
        'medium' => [10, 50],
        'hard' => [50, 100],
    ];

    [$min, $max] = $range[$difficulty];
    $questions = [];
    $correct_answers = [];

    for ($i = 0; $i < 5; $i++) {
        $num1 = rand($min, $max);
        $num2 = rand($min, $max);

        if ($operator == '/') {
            $num2 = max(1, $num2); 
            $num1 = $num2 * rand(1, 10); 
        }

        $question = "$num1 $operator $num2";
        $answer = eval("return $question;");

        $questions[] = $question;
        $correct_answers[] = $answer;
    }

    $_SESSION['correct_answers'] = $correct_answers;

    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Math Quiz</title>
        <link rel='stylesheet' href='style.css'>
    </head>
    <body>
        <div class='quiz-container'>
            <header>
                <h1>Welcome to the Math Quiz</h1>
                <p>Difficulty: <strong>" . ucfirst($difficulty) . "</strong> | Operator: <strong>$operator</strong></p>
            </header>
            <form action='process.php' method='post'>
                <div class='questions'>";
    
    foreach ($questions as $index => $q) {
        echo "<div class='question'>
                <p>Question " . ($index + 1) . ": $q = </p>
                <input type='number' name='answers[$index]' step='any' required>
              </div>";
    }

    echo "      </div>
                <button type='submit'>Submit Answers</button>
            </form>
            <footer>
                <p>Want to try a different quiz? <a href='index.php'>Go Back</a></p>
            </footer>
        </div>
    </body>
    </html>";
} else {
    header('Location: index.php');
    exit;
}
