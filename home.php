<?php
session_start();
require_once("config.php");

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    header('Location: home.php'); // Redirect to the login page
    exit();
}

if (isset($_SESSION["admin_username"])) {
    $displayName = $_SESSION["admin_username"];
    $isAdmin = true;
  } elseif (isset($_SESSION["username"])) {
    $displayName = $_SESSION["username"];
    $isAdmin = false;
  }

$catResult = $conn->query('SELECT * FROM category');
$prodResult = $conn->query('SELECT * FROM product ORDER BY RAND()');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> 

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <title>home page</title>
</head>
<body>
    <!--navigation bar-->
    <header class="" id="site_header">
        <nav>
            <div class="logo">
                <a href="home.php">
                    <p>ELECTRO</p>
                    <p>NACER</p>
                </a>
            </div>
            <div id="topnav">
                <a class="active" href="home.php">Home</a>
                <a href="">Categories</a>
                <a href="#subscribe">Subscribe</a>
            </div>
            <div class=" fs-3">
                <ion-icon name="search-outline"></ion-icon>
                <ion-icon name="bag-outline"></ion-icon>
                <ion-icon name="person-outline"></ion-icon>
                <a href="logout.php">
                    <ion-icon name="log-out-outline"></ion-icon>
                </a>
            </div>
        </nav>
    </header>
    <!--/navigation bar-->

    <section class="bg-info d-flex ">
        <div class="list-group">
            <h3>Category</h3>
            <?php
                if ($isAdmin) {
                    echo '<div class="my-2">
                    <a class="btn btn-outline-primary" href=add.php>ADD</a>
                    <a class="btn btn-outline-danger mx-3" href=Manage.php>Manage</a>
                    </div>';
                }
            

                echo '<div>';
                echo '<label>
                        <input type="checkbox" class="common_selector" id="sort_alphabetically"> Sort Alphabetically
                        </label>';
                
                echo '<label>
                    <input type="checkbox" class="common_selector" id="stock_filter"> Stock Filter
                    </label>';
                $query = "SELECT cat_name, img FROM category WHERE bl = 1 ORDER BY cat_name ASC";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="list-group-item checkbox">';
                    echo "<label>
                            <input type='checkbox' class='common_selector category' value='{$row['cat_name']}'>
                            <img src='./assets/pics_electro/{$row['img']}' alt='Category Image' style='width: 50px; height: 50px;'>
                            {$row['cat_name']}
                        </label>";
                    echo '</div>'; 
                }
                echo '</div>';
            ?>
        </div>
        <div class=" w-75">
            <h2>Products</h2>
            <div class="d-flex flex-wrap">
                <?php
                while ($row = $prodResult->fetch_assoc()) {
                        echo '<div class="w-25">';
                        echo "<img class='img-fluid' src='./assets/pics_electro/{$row['img']}' alt=''>";
                        echo "<h4>{$row['prod_name']}</h4>";
                        echo "<p>{$row['bar_code']}</p>";
                        echo "<p>{$row['prod_desc']}</p>";
                        echo "<p>{$row['final_price']}</p>";
                        echo "<p>{$row['stock_quant']}</p>";
                        echo "<p>{$row['category_fk']}</p>";
                        echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>

    <!--footer-->
    <section id="footer">
        <div class="footer1">
            <div class="logo">
                <a href="home.php">
                    <p>ELECTRO</p>
                    <p>NACER</p>
                </a>
            </div>
            <div class="social-pages">
                <ion-icon name="logo-twitter"></ion-icon>
                <ion-icon name="logo-instagram"></ion-icon>
                <ion-icon name="logo-facebook"></ion-icon>
            </div>
        </div>
        <div class="footer2">
            <div>
                <p style="font-weight: bold;">contact us</p>
                <div>
                    <ion-icon name="call-outline"></ion-icon>
                    <p>+1 (0) 234-56798</p>
                </div>
                <div>
                    <ion-icon name="business-outline"></ion-icon>
                    <p>Lorem ipsum dolor sit amet consectetur.</p>
                </div>
            </div>
            <div class="except">
                <p style="font-weight: bold;">2023 company</p>
                <p>Privacy Policy</p>
                <p>Privacy Policy</p>
            </div>
        </div>
    </section>
    <!--/footer-->

    <!--icones component-->
    <!--  <ion-icon name=""></ion-icon>  -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!--/icones component-->

    <!--bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!--/bootstrap-->

    <!--JS-->
    <script src="./assets/JS/main.js"></script>
    <!--/JS-->

    
</body>
</html>