<?php
include '../db.php';
session_start();
if(isset($_POST['addallotment'])){
    $room = $_POST['room'];
    $room = mysqli_real_escape_string($conn, $room);
    $room = htmlentities($room);
    $class = $_POST['class'];
    $class = mysqli_real_escape_string($conn, $class);
    $class = htmlentities($class);
    $start = $_POST['start'];
    $start = mysqli_real_escape_string($conn, $start);
    $start = htmlentities($start);
    $end = $_POST['end'];
    $end = mysqli_real_escape_string($conn, $end);
    $end = htmlentities($end);

    $insert = "insert into batch(class_id, room_id, startno, endno) VALUES ('$class','$room','$start','$end')";
    $insert_query = mysqli_query($conn, $insert);
    if($insert_query){
        $_SESSION['batch'] = "New allotment placed successfully.";
    }
    else{
        $_SESSION['batchnot'] = "Error!! New allotment not placed.";
    }
    header("Location: dashboard.php");
}

?>