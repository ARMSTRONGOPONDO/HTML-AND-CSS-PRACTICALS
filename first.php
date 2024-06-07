<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>first php trial</title>
</head>s

<body>
    <form method="post">
        <fieldset>
            <legend>TRIAL</legend>
            Enter first number
            <input type="number" name="number1"><br><br>
            Enter second number
            <input type="number" name="number2"><br><br>s
            <input type="submit" name="submit" value="Add">
        </fieldset>
    </form>
    <?php
    if (isset($_POST['submit'])) {
        $number1 = $_POST['number1'];
        $number2 = $_POST['number2'];
        $sum = $number1 + $number2;
        echo "The sum of $number1 and $number2 is:" .
            $sum;
        }
    ?>
</body>

</html>