<?php
include "../link.php";
if(isset($_POST['display'])){
	$roomid = $_POST['display'];
	echo "<table>
			<thead>
			<tr>
			<th>Name</th>
			<th>Class</th>
			<th>Roll No.</th>
			</tr>
			</thead>
			<tbody>
	";
	$display = "select name, year, dept, division, rollno from students, batch where roomi_id='$roomid' and startno<=";
	$display_query = mysqli_query($conn, $display);
	if(mysqli_num_rows($display_query)>0){
		while($row = mysqli_fetch_assoc($display_query)){
			echo "<tr>
					<td>".$row['name']."</td>
					<td>".$row['year']." ".$row['dept']." ".$row['division']."</td>
					<td>".$row['rollno']."</td>
				</tr>
					";
		}
	}
}
?>