<?php
session_start();

include("connection.php");

if(isset($_POST['login_submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM login WHERE email = :email AND password = :password";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $count = $stmt->rowCount();

    if ($count == 1){
        $_SESSION['email'] = $email;
        header("Location:films.html");
        exit();
    }
    else {
        
        $sql = "SELECT * FROM signup WHERE email = :email AND password = :password";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $count = $stmt->rowCount();

        if ($count == 1){
            $_SESSION['email'] = $email;
            header("Location:films.html");
            exit();
        } 
        else  {
        
            $sql = "SELECT * FROM admin WHERE email = :email AND password = :password";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $count = $stmt->rowCount();
    
            if ($count == 1){
                $_SESSION['email'] = $email;
                header("Location:./admin/admin.html");
                exit();
            } 
            else{
                echo '<script>
                     window.location.href = "index.php";
                     alert("Login failed. Invalid username or password.")
                     </script>';
            }
        }
    }
} 
?>

<!DOCTYPE html>
<html>

<head>
    <title>Reservio</title>
    <link rel="next" type="text/html" href="films.html">
    <link rel="next" type="text/html" href="./admin/admin.html">
    <link rel="icon" href="cin.jpg" type="image/svg" sizes="16x16 32x32">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            padding: 0;
            margin: 0;
        }


        .main {
            width: 100%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7)70%, rgba(0, 0, 0, 0.7)70%), url(./admin/home.jpg);
            background-position: center;
            background-size: cover;
            height: 109vh;

        }

        .main .navbar {
            /*width: 400px;
            float: left;
            height: 70px;*/
            color: #ce2a2ae7;
        }



        .logo {
            color: #ff7200;
            font-size: 30px;
            font-family: Arial;
            padding-left: 20px;
            float: left;
            padding-top: 10px;
            background-color: #00000000;

        }

        .logo a {
            text-decoration: none;
            color: #ff7200;



        }

        .menu {
            width: 600px;
            float: right;
            height: 70px;

        }

        ul {
            float: left;
            display: flex;
            justify-content: center;
            align-items: center;

        }

        ul li {
            list-style: none;
            margin-left: 62px;
            margin-top: 27px;
            font-size: 14px;
        }

        ul li a {
            text-decoration: none;
            color: antiquewhite;
            font-family: Arial;
            font-size: 15px;
            font-weight: bold;
            transition: 0.4s ease-in-out;
            background: none;
        }

        ul li a:hover {
            color: #ff7200;
        }

        .content {
            width: 800px;
            /*height: auto;
            margin: auto;*/
            color: #fff;
            /*position: relative;*/
            padding-top: 15%;
            padding-left: 25%;

        }

        .content .par {
            padding-left: 150px;
            padding-bottom: 30px;
            font-family: Arial;
            letter-spacing: 1.2px;
            line-height: 30px;
        }

        .content h1 {
            font-family: 'Times New Roman';
            font-size: 50px;
            padding-left: 70px;
            padding-right: 70px;
            margin-top: 9%;
            letter-spacing: 2px;
        }

        .content .bn1 {
            width: 120px;
            height: 42px;
            background: transparent;
            border: 2px solid #ff7200;
            margin-bottom: 10px;
            margin-left: 210px;
            font-size: 15px;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.5s;

            font-weight: 700;
            text-transform: uppercase;
            margin-left: 320px;
            text-align: center;
            display: block;


        }

        .content .bn1 a {
            color: #f09819;
            text-decoration: none;
        }

        .content .bn {

            margin-left: 200px;
            padding: 13px 33px;
            text-align: center;
            text-transform: uppercase;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;
            border-radius: 10px;
            display: block;
            border: 0px;
            font-weight: 700;
            box-shadow: 0px 0px 14px -7px #f09819;
            background-image: linear-gradient(45deg, #FF512F 0%, #F09819 51%, #FF512F 100%);
            cursor: pointer;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
        }

        .content .bn a {
            text-decoration: none;
            color: #fff;
        }

        .content .bn:hover {
            background-position: right center;
            color: #fff;
            text-decoration: none;
        }

        .content .bn:active {
            transform: scale(0.95);
        }

        .content .bn1:active {
            transform: scale(0.95);
        }

        span {
            color: #fff;
        }

        /*login form*/
        .form {
            width: 270px;
            height: 380px;
            background: #fff;
            position: absolute;
            top: 30%;
            left: 70%;
            border-radius: 10px;
            padding: 20px;

        }

        .form h2 {
            font-family: sans-serif;
            width: 220px;
            text-align: center;
            color: #ff7200;
            font-size: 22px;
            margin: 2px;
            padding: 8px;
        }

        .form input {
            width: 240px;
            height: 35px;
            background: transparent;
            border: #fff;
            margin-left: 15px;
            border-bottom: 1px solid #F09819;
            border-radius: 10px;
            border-top: none;
            border-left: none;
            border-right: none;
            color: rgb(15, 15, 15);
            letter-spacing: 1px;
            margin-top: 30px;
            right: 15px;
            font-family: sans-serif;

        }

        .form input:focus {
            outline: none;
        }

        .btn {
            width: 240px;
            height: 40px;
            border-radius: 10px;
            border: none;
            background-image: linear-gradient(45deg, #FF512F 0%, #f09819 51%, #ee5031 100%);
            margin-top: 30px;
            font-size: 18px;
            cursor: pointer;
            color: #fff;
            transition: 0.4s ease;
            margin-left: 15px;
        }

        .btn:hover {
            background-position: right center;
            color: #fff;
            text-decoration: none;
        }

        .btn:active {
            transform: scale(0.95);
        }

        .btn a {
            text-decoration: none;
            color: #fff;
        }

        .form .link {
            font-family: Arial;
            font-size: 17px;
            padding-top: 20px;
            text-align: center;
            color: gray;
        }

        .form .link a {
            text-decoration: none;
            color: rgba(240, 152, 25, 1);
        }

        .form h2 i {
            position: absolute;
            top: 8px;
            right: 8px;
            font-size: 20px;
        }

        .popup {
            display: none;
        }

        .popup.open {
            display: flex;
            animation: show-popup 0.5s;
        }

        @keyframes show-popup {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }

        }

        .icon {
            height: 100px;
            width: 100px;

        }
    </style>

</head>

<body>
    <div class="main">
        <!-- Create the navigation bar-->
        <div class="navbar">
            <div class="logo">
                <h2> <a href="films.html"><span>Reser</span>vio </a></h2>
            </div>

            <div class="menu">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">soon</a></li>
                    <li><a href="#">Currently</a></li>
                    <li><a href="#">About</a></li>
                </ul>
            </div>
        </div>

        
        <!-- contents-->
        <div class="content">
            <h1>Welcom to <span>Reservio</span></h1>
            <p class="par">you can reserve your ticket right now</p>
            <button class="bn"><a href="./admin/admin.html">JOIN US</a></button>
            <button class="bn1" onclick="togglelogin()"><a href="#">LOGIN</a></button>
           

<!-- login popup -->
<div class="popup" id="login_popup">
    <div class="popup-content">
        <div class="form">
            <h2>LOGIN <i class="fa-solid fa-xmark" onclick="togglelogin()"></i></h2>
            <div class="form-element">
                <form name="form" action="" method="post">
                    <input type="email" name="email" placeholder="Enter email here">
                    <input type="password" name="password" placeholder="Enter password here">
                    <button class="btn" type="submit" name="login_submit" value="Signup">LOGIN</button>
                </form>
                <p class="link">Don't have an account? <a onclick="togglesignup()">Sign up here</a></p>
            </div>
        </div>
    </div>
</div>


            
            
            <!-- signup popup -->
            <div class="popup" id="signup_popup">
                <div class="popup-content">
                    <div class="form">
                        <h2>SIGN UP <i class="fa-solid fa-xmark" onclick="togglelogin()"></i></h2>
                        <div class="form-element">
                          <form method="POST">
                            <input type="text" name="name" placeholder="Enter name here">
                            <input type="email" name="email" placeholder="Enter email here">
                            <input type="password" name="password" placeholder="Enter password here">
                            <input type="password" name="c_password" placeholder="confirm your password">
                            <button class="btn" type="submit" name="signup_submit" value="Submit">SIGN UP</button>

                          </form>
                          <?php

                          include("connection.php");
 


                            if (isset($_POST['signup_submit'])) {
    
                                $name = $_POST['name'];
                                $email = $_POST['email'];
                                $password = $_POST['password'];
                                $c_password = $_POST['c_password'];

   
                            if ($password != $c_password) {
                                 echo "Passwords do not match.";
                            } else {
      
                            $stmt = $connexion->prepare("SELECT * FROM signup WHERE email=:email");
                            $stmt->bindParam(":email", $email);
                            $stmt->execute();
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);
      
                            if ($result) {
                                echo "User with this email already exists.";
                            } else {
       
                            $stmt = $connexion->prepare("INSERT INTO signup (name, email, password) VALUES (:name, :email, :password)");
                            $stmt->bindParam(":name", $name);
                            $stmt->bindParam(":email", $email);
                            $stmt->bindParam(":password", $password);
                            $stmt->execute();

                                echo "Signup successful!";
                            }
                        }
                     }
 
?>

                            <p class="link">Already have an account? <a onclick="togglelogin()">Login here</a></p>
                        </div>
                    </div>
                </div>
            </div>



            <script>
                function togglelogin() {
                    document.querySelector("#login_popup").classList.toggle("open");
                }

                function togglesignup() {
                    document.querySelector("#signup_popup").classList.toggle("open");
                }

            </script>
        </div>
        <?php include("footer.php"); ?>
        
</body>


</html>
