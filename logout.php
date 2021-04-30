<?php
session_start();
include "db.php";


$_SESSION['loginmsg'] = "Logged Out Successfully";
if($_SESSION['login']=="student"){
	unset($_SESSION['login']);
	header('Location: login_student.php');
}
else{
	unset($_SESSION['login']);
	header('Location: login_admin.php');
}



?>