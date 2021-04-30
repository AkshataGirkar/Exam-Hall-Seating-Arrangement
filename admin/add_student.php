<?php 
session_start();
?>
<html>
<head>
    <title>Manage Student</title>
    <link rel="stylesheet" href="common.css">
    <?php include'../link.php' ?>
    <style type="text/css">
    </style>
    </head>
<body>
    <?php
    if(isset($_POST['deletestudent'])){
        $student = $_POST['deletestudent'];
        $delete = "delete from students where student_id = '$student'";
        $delete_query = mysqli_query($conn, $delete);
        if($delete_query){
            $_SESSION['delstudent'] = "Student deleted successfully";
        }
        else{
            $_SESSION['delnotstudent'] = "Error!! student not deleted.";
        }
    }
?>
    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header">
                <h4>DASHBOARD</h4>   
            </div>
            <ul class="list-unstyled components">
                    <li>
                        <a href="add_class.php"><img src="https://img.icons8.com/ios-filled/26/ffffff/google-classroom.png"/> Classes</a>
                    </li>
                    <li>
                        <a href="add_student.php" class="active_link"><img src="https://img.icons8.com/ios-filled/25/ffffff/student-registration.png"/> Students</a>
                    </li>
                    <li>
                        <a href="add_room.php"><img src="https://img.icons8.com/metro/25/ffffff/building.png"/> Rooms</a>
                    </li>
                    <li>
                        <a href="dashboard.php"><img src="https://img.icons8.com/nolan/30/ffffff/summary-list.png"/> Allotment</a>
                    </li>
                </ul>
            </nav>
<div id="content">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-info">
                <img src="https://img.icons8.com/ios-filled/19/ffffff/menu--v3.png"/>
            </button><span class="page-name"> Manage Students</span>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <img src="https://img.icons8.com/ios-filled/20/ffffff/menu--v3.png"/>
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
    <div class="main-content">
        <?php
        if(isset($_SESSION['student'])){
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>".$_SESSION['student']."<button class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            unset($_SESSION['student']);
        }
        if(isset($_SESSION['studentnot'])){
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>".$_SESSION['studentnot']."<button class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            unset($_SESSION['studentnot']);
        }
        if(isset($_SESSION['delstudent'])){
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>".$_SESSION['delstudent']."<button class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            unset($_SESSION['delstudent']);
        }
        if(isset($_SESSION['delnotstudent'])){
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>".$_SESSION['delnotstudent']."<button class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            unset($_SESSION['delnotstudent']);
        }
        ?>
        <div class="table-responsive border">
            <table class="table table-hover text-center">
               <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Class</th>
                    <th>RollNo.</th>
                    <th>Password</th>
                    <th>Actions</th>
                </tr>   
                </thead>
                <tbody>
                <tr>
                <form action="addstudent.php" method="post">
                    <th class="py-3 bg-light">
                        <input class="form-control" type="text" name="sname">
                    </th>
                    <th class="py-3 bg-light">
                        <select id="sem" name="sclass" class="form-control">
                    <?php 
                    $selectclass = "select * from class order by year, dept, division";
                    $selectclassQuery = mysqli_query($conn, $selectclass);
                    if($selectclassQuery){
                        echo "<option value=''>--select--</option>";
                        while($row = mysqli_fetch_assoc($selectclassQuery)){
                            echo "<option value=".$row['class_id'].">".$row['year']." ".$row['dept']." ".$row['division']."</option>";
                        }
                    }
                    else{
                        echo "<option value=''>No options</option>";
                    }
                    ?>
                    </select>
                    </th>
                    <th class="py-3 bg-light">
                        <input class="form-control" type="number" name="sroll" size=4>
                    </th>
                    <th class="py-3 bg-light">
                        <input class="form-control" type="Password" name="spwd">
                    </th>
                    <th class="py-3 bg-light">
                        <button class="btn btn-primary" name="addstudent">Add</button>
                    </th>
                </tr>  
            </form>
                <?php
                $selectclass = "Select * from students,class where students.class=class.class_id order by year, dept, division, rollno";
                $selectclassquery = mysqli_query($conn, $selectclass);
                if($selectclassquery){
                    while ($row = mysqli_fetch_assoc($selectclassquery)) {
                        echo "<tr>
                        <td>".$row['name']."</td>
                        <td>".$row['year']." ".$row['dept']." ".$row['division']."</td>
                        <td>".$row['rollno']."</td>
                        <td>-</td>
                        <form method='post'>
                        <td>
                            <button class='btn btn-light px-1 py-0' type='submit' value='".$row['student_id']."' name='deletestudent'>
                            <img src='https://img.icons8.com/color/25/000000/delete-forever.png'/>
                            </button>
                        </td>
                        </form>
                    </tr>";
                    }
                }
                ?>
                </tbody>
        </table>
    </div>
</div>
</div>
</div>
<?php include'footer.php' ?>