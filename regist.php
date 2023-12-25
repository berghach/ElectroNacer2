<?php
session_start();

require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["user_name"];
    $email = $_POST["e_mail"];
    $password = $_POST["psw"];
    $confirm_password = $_POST["confirm_psw"];

    function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    // Validation errors array
    $errors = [];

    // Validation
    if (empty($username)) {
        $errors['username'] = "Error: User Name is required.";
    }
     
    if ($password !== $confirm_password) {
        $errors['password'] = "Error: Passwords do not match.";
    }

    if (!isValidEmail($email)) {
        $errors['email'] = "Error: Invalid email address.";
    }

    // If there are errors, store them in the session variable
    if (!empty($errors)) {
        $_SESSION['register_errors'] = $errors;
        header("Location: signup.php");
        exit();
    }

    // Establish a database connection (replace these with your actual database details)
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL Injection Protection
    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert user data into the clients table
    $sql = "INSERT INTO client (username, e_mail, psw) VALUES ('$username', '$email', '$hashed_password')";

    if ($conn->query($sql) == true) {
        echo '<div style="color: green; font-weight: bold; text-align: center;">User registered successfully.</div>';
        header("Location: login.php");
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
