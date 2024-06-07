<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DISCOUNT</title>
</head>

<body>
    <fieldset>
        <form method="POST" action="">
            Enter the amount spent:
            <input type="number" name="amount" required><br><br>
            <input type="submit" name="submit" value="Calculate Discount">
        </form>
    </fieldset>

    <?php
    function calculate($amount) {
        if ($amount > 30000) {
            return $amount * 0.25;
        } else if ($amount > 25000 && $amount <= 30000) {
            return $amount * 0.2;
        } else if ($amount > 15000 && $amount <= 25000) {
            return $amount * 0.15;
        } else if ($amount > 1000 && $amount <= 15000) {
            return $amount * 0.1;
        } else {
            return "invalid amount please try again";
        }
    }

    if (isset($_POST['submit'])) {
        $amount = $_POST['amount'];
        $discount = calculate($amount);
        echo "<p>Amount spent: $$amount</p>";
        echo "<p>Discount: $$discount</p>";
        echo "<p>Total after discount: $" . ($amount - $discount) . "</p>";
    }
    ?>
</body>

</html>