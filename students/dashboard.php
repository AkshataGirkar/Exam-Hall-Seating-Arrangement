<?php
session_start();
?>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="../admin/common.css">
    <?php include'../link.php' ?>
    </head>
<body>
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <span class="page-name"> DASHBOARD</span>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                   <img src="https://img.icons8.com/ios-filled/19/ffffff/menu--v3.png"/>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="../logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
            <div class="main-content d-lg-flex justify-content-around">
<?php
    if(isset($_SESSION['loginid'])){
        $id = $_SESSION['loginid'];
        
        $select_student="select * from students, class where student_id='$id' and class=class_id";
        $select_student_query = mysqli_query($conn, $select_student);
        if(mysqli_num_rows($select_student_query)>0){
            $row = mysqli_fetch_assoc($select_student_query);
            $class = $row['class']; 
            $roll = $row['rollno'];

            echo "<div class='mt-4 '>
                    <h2>".$row['name']."</h2>
                    <h6 class='py-2'>".$row['year']." ".$row['dept']." ".$row['division']."
                    </h6>Roll No. ".$row['rollno']."
                </div>
                <div>
                    <h5 align=center class='mt-4 mb-3 text-primary'>Exam Seating Allotment</h5>";

            echo "<table class='table text-center table-bordered'>
                <tr>
                    <th>Room Number</th>
                    <th>Floor Number</th>
                    <th>Start Roll Number</th>
                    <th>End Roll Number</th>
                </tr>
            ";

            $allotment = "select year, dept, division, room_no, floor, startno, endno from batch, room, class where room_id=rid and batch.class_id=class.class_id and batch.class_id='$class' and startno<='$roll' and endno>='$roll'";
            $allotment_query = mysqli_query($conn, $allotment);

            if(mysqli_num_rows($allotment_query)>0){
                $array = mysqli_fetch_assoc($allotment_query);
                echo "<tr>
                    <td>".$array['room_no']."</td>
                    <td>".$array['floor']."</td>
                    <td>".$array['startno']."</td>
                    <td>".$array['endno']."</td>
                </tr>
                ";
            }
            else{
                echo "<tr><td>Exam Seat Not Allotted</td></tr>";
            }
            echo "</table>";
        }
        else{
            echo "No student with Id = '$id'";
        }
    }
?>
</div>
            </div>
        </div>
    </body>
</html>