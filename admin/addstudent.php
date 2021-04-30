<?php
include "../db.php";
session_start();
if(isset($_POST['addstudent'])){
	$name = $_POST['sname'];
	$name = mysqli_real_escape_string($conn, $name);
	$name = htmlentities($name);
	$password = $_POST['spwd'];
	$password = mysqli_real_escape_string($conn, $password);
	$password = htmlentities($password);
	$class = $_POST['sclass'];
	$class = mysqli_real_escape_string($conn, $class);
	$class = htmlentities($class);
	$roll = $_POST['sroll'];
	$roll = mysqli_real_escape_string($conn, $roll);
	$roll = htmlentities($roll);
	
	$insert = "insert into students(name,password, class, rollno) VALUES ('$name','$password','$class', '$roll')";
	$insert_query = mysqli_query($conn, $insert);
	if($insert_query){
		$_SESSION['student'] = "New student added successfully.";
	}
	else{
		$_SESSION['studentnot'] = "Error!! New student not added.";
	}
	header("Location: add_student.php");
}

?>