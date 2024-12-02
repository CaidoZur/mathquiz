<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Math Quiz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="quiz-container">
        <h1>Math Quiz</h1>
        <form action="quiz.php" method="post">
            <label for="difficulty">Select Difficulty:</label>
            <select name="difficulty" id="difficulty" required>
                <option value="easy">Easy</option>
                <option value="medium">Medium</option>
                <option value="hard">Hard</option>
            </select>

            <label for="operator">Select Operator:</label>
            <select name="operator" id="operator" required>
                <option value="+">Addition (+)</option>
                <option value="-">Subtraction (-)</option>
                <option value="*">Multiplication (*)</option>
                <option value="/">Division (/)</option>
            </select>

            <button type="submit">Start Quiz</button>
        </form>
    </div>
</body>
</html>
