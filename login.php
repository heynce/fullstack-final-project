<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="http://localhost:80/signup.css"></head>
<body>
    
    <h1>Login</h1>
    <nav>
        
        <div class="navigation-links" id="navlinks">
            <i class="fa fa-window-close" onclick="hideMenu()"></i> <!-- javascript use  -->

            <ul>
                <li>
                    <a href="./front page.html">Home</a>
                </li>
                <li>
                    <a href="./shop.html">Shop</a>
                </li>
                <li>
                    <a href="">About</a>
                </li>
                <li> 
                    <a href="./contact.html">Contact</a>
                </li>
                <li> 
                    <a href="./signup1.html">Log in</a>
                </li>
            </ul>
        </div>
        <i class="fa fa-bars" onclick="showMenu()"></i>
    </nav>

    <div class="box">
    <img src="http://localhost:80/logo.jpg">
        
        <div class="page">
            <div class="header1">
            <a id="login" class="active" href="#login">login</a>
                <a id="signup" href="#signup">signup</a>
            </div>
        
    
    <form method="post">
        <label for="email">email</label>
        <input type="email" name="email" id="email"
               value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
        
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        
        <button>Log in</button>
    </form>
            <div id="check">
                        <input type="checkbox" id="remember">
                        <label for="remember">Remember information</label>
                    </div>
                    <br>
                    <br>
                    <input type="submit" value="Login">
                    <a href="#">Forgot Password?</a>
    
    
</body>
</html>








