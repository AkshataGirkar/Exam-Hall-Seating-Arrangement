<?php

$conn = mysqli_connect("localhost:3307","root","","seating");
if($conn){
	// echo "Successfully";
}
else{
    die("no conn" . mysqli_connect_error());
}

?>