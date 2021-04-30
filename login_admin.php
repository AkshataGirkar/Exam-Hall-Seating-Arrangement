<?php
session_start();
include "db.php";

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $name = mysqli_real_escape_string($conn, $name);
    $name = htmlentities($name);
    $password = $_POST['password'];
    $password = mysqli_real_escape_string($conn, $password);
    $password = htmlentities($password);

    $select_admin = "select name, password from admin where name='$name' and password='$password'";
    $select_admin_query = mysqli_query($conn, $select_admin);
    if(mysqli_num_rows($select_admin_query)>0){
        $_SESSION['login'] = "admin";
        header('Location: admin/dashboard.php');
    }
    else{
        $_SESSION['loginmsg'] = "Incorrect Credentials";
    }
}
?>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Log in</title>
    <style>
        body {
            background-color: #F3EBF6;
            font-family: 'Ubuntu', sans-serif;
        }

        .main {
            background-color: #FFFFFF;
            width: 400px;
            height: 400px;
            margin: 5em auto;
            border-radius: 1.5em;
            box-shadow: 0px 11px 35px 2px rgba(0, 0, 0, 0.14);
        }

        .sign {
            padding-top: 50px;
            color: #8C55AA;
            font-weight: bold;
            font-size: 23px;
        }

        .name {
            width: 76%;
            color: rgb(38, 50, 56);
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 1px;
            background: rgba(136, 126, 126, 0.04);
            padding: 10px 20px;
            border: none;
            outline: none;
            box-sizing: border-box;
            border: 2px solid rgba(0, 0, 0, 0.02);
            border-radius: 20px;
            margin-left: 46px;
            text-align: center;
            margin-bottom: 27px;
        }

        form.form1 {
            padding-top: 10px;
        }

        .pass {
            width: 76%;
            color: rgb(38, 50, 56);
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 1px;
            background: rgba(136, 126, 126, 0.04);
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            outline: none;
            box-sizing: border-box;
            border: 2px solid rgba(0, 0, 0, 0.02);
            margin-bottom: 50px;
            margin-left: 46px;
            text-align: center;
            margin-bottom: 27px;
        }


        .name:focus,
        .pass:focus {
            border: 2px solid rgba(0, 0, 0, 0.18) !important;

        }

        .submit {
            cursor: pointer;
            border-radius: 5em;
            color: #fff;
            background: linear-gradient(to right, #9C27B0, #E040FB);
            border: 0;
            padding: 10px 40px;
            margin-top: 10px;
            margin-left: 35%;
            font-size: 13px;
            box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.04);
            text-shadow: 0px 0px 3px rgba(117, 117, 117, 0.12);
            color: #fff;
        }
        h1{
            text-align: center;
            color: #9C27B0;
            padding-top: 30px;
        }
        .login-div{
            height: 30px;
        }
        .loginmsg{
            text-align: center;
            font-family: Georgia, serif;
            color: red;
        }
        .role-msg{
            font-family: Georgia, serif;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <h1>Exam Hall Seating Arrangement</h1>
    <div class="main">
        <p class="sign" align="center">ADMIN LOGIN</p>
        <div class="login-div">
            <p class="loginmsg">
                <?php
                if(isset($_SESSION['loginmsg'])){
                    echo $_SESSION['loginmsg'];
                    unset($_SESSION['loginmsg']);
                }
                ?>
            </p>
        </div>
        <form class="form1" method="post">
            <input class="name" name="name" type="text" align="center" placeholder="Enter Name">
            <input class="pass" name="password" type="password" align="center" placeholder="Password">
            <button class="submit" name="submit" type="submit" align="center">LOGIN</button>
            <p align=center class="role-msg">Are you a student? <a href="login_student.php">Login Here</a></p>
    </div>
</body>
</html>