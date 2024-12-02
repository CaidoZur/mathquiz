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

} else {
    header('Location: index.php');
    exit;
}
