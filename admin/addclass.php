<?php
include '../db.php';
session_start();
if(isset($_POST['addclass'])){
	$year = $_POST['year'];
	$year = mysqli_real_escape_string($conn, $year);
	$year = htmlentities($year);
	$dept = $_POST['dept'];
	$dept = mysqli_real_escape_string($conn, $dept);
	$dept = htmlentities($dept);
	$div = $_POST['div'];
	$div = mysqli_real_escape_string($conn, $div);
	$div = htmlentities($div);
	
	$insert = "insert into class(year, dept, division) VALUES ('$year','$dept','$div')";
	// echo $insert;
	$insert_query = mysqli_query($conn, $insert);
	if($insert_query){
		$_SESSION['class'] = "New class added successfully.";
	}
	else{
		$_SESSION['classnot'] = "Error!! New class not added.";
	}
	header("Location: add_class.php");
}

?>