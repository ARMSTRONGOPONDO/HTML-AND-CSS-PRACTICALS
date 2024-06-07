<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($_POST['password-confirm'])) {
        // Sign up form submission
        $passwordConfirm = $_POST['password-confirm'];

        if ($password === $passwordConfirm) {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Save user data to a file (or update to use a database)
            $file = fopen('users.txt', 'a');
            fwrite($file, $username . ',' . $hashedPassword . "\n");
            fclose($file);
            echo "<script>alert('Account created successfully');</script>";
        } else {
            echo "<script>alert('Passwords do not match');</script>";
        }
    } else {
        // Login form submission
        $found = false;
        $file = fopen('users.txt', 'r');
        while ($line = fgets($file)) {
            list($storedUsername, $storedPassword) = explode(',', trim($line));
            if ($storedUsername === $username && password_verify($password, $storedPassword)) {
                $found = true;
                break;
            }
        }
        fclose($file);

        if ($found) {
            $_SESSION['username'] = $username;
            echo "<script>alert('Welcome to our website $username'); window.location.href = 'shcoolflix.html';</script>";
        } else {
            echo "<script>alert('Invalid username or password, please try again or create an account');</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login-style.css">
</head>

<body>

    <div class="container">
        <div class="login-container">
            <form id="login-form" method="POST" action="">
                <fieldset>
                    <h2>Login</h2>
                    <div class="form-group">
                        <label for="login-username">Username:</label>
                        <input type="text" id="login-username" name="username" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="login-password">Password:</label>
                        <input type="password" id="login-password" name="password" required>
                    </div>
                    <br>
                    <div align="center">
                        <input type="submit" name="submit" value="Sign In">
                    </div>
                    <br>
                    <div align="center">
                        <button type="button" id="show-signup">Don't have an account? Sign Up</button>
                    </div>
                </fieldset>
            </form>
        </div>

        <div class="signup-container" style="display:none;">
            <form id="signup-form" method="POST" action="">
                <fieldset>
                    <h2>Sign Up</h2>
                    <div class="form-group">
                        <label for="signup-username">Username:</label>
                        <input type="text" id="signup-username" name="username" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="signup-password">Password:</label>
                        <input type="password" id="signup-password" name="password" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="signup-password-confirm">Confirm Password:</label>
                        <input type="password" id="signup-password-confirm" name="password-confirm" required>
                    </div>
                    <br>
                    <div align="center">
                        <input type="submit" name="submit" value="Sign Up">
                    </div>
                    <br>
                    <div align="center">
                        <button type="button" id="show-login">Already have an account? Sign In</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const loginForm = document.getElementById('login-form');
        const signupForm = document.getElementById('signup-form');
        const showSignupButton = document.getElementById('show-signup');
        const showLoginButton = document.getElementById('show-login');
        const loginContainer = document.querySelector('.login-container');
        const signupContainer = document.querySelector('.signup-container');

        // Toggle to sign-up form
        showSignupButton.addEventListener('click', function() {
            loginContainer.style.display = 'none';
            signupContainer.style.display = 'block';
        });

        // Toggle to login form
        showLoginButton.addEventListener('click', function() {
            signupContainer.style.display = 'none';
            loginContainer.style.display = 'block';
        });

        // Login form submission
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const username = document.getElementById('login-username').value;
            const password = document.getElementById('login-password').value;

            // Add an AJAX call here to check credentials from the server

            // Simulate a successful login
            if (username === 'Armstrong' && password === 'password') {
                alert("Welcome to our website " + username);
                window.location.href = 'shcoolflix.html';
            } else {
                alert('Invalid username or password, please try again or create an account');
            }
        });

        // Sign-up form submission
        signupForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const username = document.getElementById('signup-username').value;
            const password = document.getElementById('signup-password').value;
            const passwordConfirm = document.getElementById('signup-password-confirm').value;

            if (password !== passwordConfirm) {
                alert('Passwords do not match');
                return;
            }

            // Add an AJAX call here to save the user data to the server

            // Simulate a successful sign-up
            alert('Account created successfully');
            signupContainer.style.display = 'none';
            loginContainer.style.display = 'block';
        });
    });
    </script>
</body>

</html>