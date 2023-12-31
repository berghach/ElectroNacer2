<?php

session_start(); 
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["ID"];
    $password = $_POST["psw"];

    $username = mysqli_real_escape_string($conn, $username);

    $adminResult = $conn->query("SELECT * FROM admins WHERE username = '$username'");

    if ($adminResult->num_rows > 0) {
        $adminRow = $adminResult->fetch_assoc();
        $adminStoredPassword = $adminRow["passw"];
    
        
        if ($password === $adminStoredPassword) {
            $_SESSION["admin_username"] = $username;
            $_SESSION["is_admin"] = true;

            header("Location: home.php");
            exit();
        } else {
            echo "Error: Incorrect admin password.";
        }
    } else {
        // Check if it's a regular user
        $userResult = $conn->query("SELECT * FROM client WHERE username = '$username'");

        if ($userResult->num_rows > 0) {
            $userRow = $userResult->fetch_assoc();
            $hashedPassword = $userRow["psw"];
            if (password_verify($password, $hashedPassword)) {
                $_SESSION["username"] = $username;
                header("Location: home.php");
                exit();
            } else {
                echo "Error: Incorrect password.";
            }
        } else {
            echo "Error: User not found.";
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/CSS/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Login ElectroNacer</title>
</head>
<body class="bg-white m-0 overflow-x-hidden">
    
    <section class="container-fluid m-0 p-0 d-sm-flex bg-primary align-items-center">
        <div>
            <img class="img-fluid" style="height: 100vh;" src="./assets/pics_electro/ElectroNacer.png" alt="">
        </div>
        <div class="container-fluid d-flex flex-column align-items-center p-2">
            <h1>Login</h1>
            <form action="login.php" method="POST" class="d-grid col-11 gap-3">
                <label  for="ID">User name</label>
                <input class="rounded-2" type="text" name="ID" id="ID">
                <label for="psw">Password</label>
                <input class="rounded-2" type="password" name="psw" id="psw">
                <button class="w-25 btn btn-light m-auto" type="submit">log in</button>
            </form>
            <p class="mt-3">I don't have an account:
                <a class="text-light" href="./signup.php">create new account</a>
            </p>
        </div>

    </section>

    <!--icones component-->
    <!--  <ion-icon name=""></ion-icon>  -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!--/icones component-->

    <!--bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" 
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" 
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!--/bootstrap-->

    <!--JS-->
    <script src="./assets/JS/main.js"></script>
    <!--/JS-->

</body>
</html>