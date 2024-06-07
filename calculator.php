<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multipurpose Calculator</title>
    <link rel="stylesheet" href="calculatorcss.css">
</head>

<body>
    <div class="calculator-container">
        <h1>Multipurpose Calculator</h1>
        <form method="POST" action="">
            <fieldset>
                <label for="num1">Enter first number:</label>
                <input type="number" step="any" id="num1" name="num1" required><br><br>

                <label for="num2">Enter second number (optinal):</label>
                <input type="number" step="any" id="num2" name="num2"><br><br>

                <label for="operation">Select operation:</label>
                <select id="operation" name="operation" required>
                    <option value="add">Addition</option>
                    <option value="subtract">Subtraction</option>
                    <option value="multiply">Multiplication</option>
                    <option value="divide">Division</option>
                    <option value="exponent">Exponentiation</option>
                    <option value="percentage">Percentage</option>
                    <option value="sqrt">Square Root</option>
                    <option value="log">Logarithm</option>
                </select><br><br>

                <input type="submit" name="submit" value="Calculate">
            </fieldset>
        </form>

        <?php
        function calculatePercentage($num1, $num2)
            {
            return ($num1 / 100) * $num2;
            }

        function calculateSquareRoot($num1)
            {
            if ($num1 >= 0) {
                return sqrt($num1);
                }
            else {
                return "Error: Square root of a negative number";
                }
            }

        function calculateLogarithm($num1)
            {
            if ($num1 > 0) {
                return log($num1);
                }
            else {
                return "Error: Logarithm of non-positive number";
                }
            }

        if (isset($_POST['submit'])) {
            $num1 = $_POST['num1'];
            $num2 = isset($_POST['num2']) ? $_POST['num2'] : null;
            $operation = $_POST['operation'];
            $result = null;

            switch ($operation) {
                case 'add':
                    $result = $num1 + $num2;
                    break;
                case 'subtract':
                    $result = $num1 - $num2;
                    break;
                case 'multiply':
                    $result = $num1 * $num2;
                    break;
                case 'divide':
                    if ($num2 != 0) {
                        $result = $num1 / $num2;
                        }
                    else {
                        $result = "Error: Division by zero";
                        }
                    break;
                case 'exponent':
                    $result = pow($num1, $num2);
                    break;
                case 'percentage':
                    $result = calculatePercentage($num1, $num2);
                    break;
                case 'sqrt':
                    $result = calculateSquareRoot($num1);
                    break;
                case 'log':
                    $result = calculateLogarithm($num1);
                    break;
                default:
                    $result = "Invalid operation selected";
                    break;
                }

            echo "<h2>Result: $result</h2>";
            }
        ?>
    </div>
</body>

</html>