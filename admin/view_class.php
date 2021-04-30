<?php
session_start();
?>
<html>
<head>
    <link rel="stylesheet" href="common.css">
    <title>Classes</title>
    <?php include'../link.php' ?>
    <style type="text/css">
    </style>
</head>
<body>
<div class="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header">
            <h4>Faculty Name</h4>   
        </div>
        <ul class="list-unstyled components">
            <li>
                <a href="add_class.php" class="active_link"><img src="https://img.icons8.com/windows/28/ffffff/google-classroom.png"/> Classes</a>
            </li>
            <li>
                <a href="add_student.php"><img src="https://img.icons8.com/ios-filled/26/ffffff/student-registration.png"/> Students</a>
            </li>
            <li>
               <a href="add_room"><img src="https://img.icons8.com/metro/24/ffffff/building.png"/> Rooms</a>
            </li>
            <li>
                <a href="dashboard.php"><img src="https://img.icons8.com/windows/25/ffffff/shared-document.png"/> Allotment</a>
            </li>
        </ul>
    </nav>
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-warning">
                    <img src="https://img.icons8.com/ios-filled/22/ffffff/menu--v3.png"/>
                </button><span class="page-name"> Manage Class</span>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-align-justify"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="main-content">
            <table class="table table-responsive">
                <tr>
                    <th>Year</th>
                    <th>Department</th>
                    <th>Division</th>
                    <th>Actions</th>
                </tr>
            <?php
            $selectclass = "Select * from class";
            $selectclassquery = mysqli_query($conn, $selectclass);
            if($selectclassquery){
                while ($row = mysqli_fetch_assoc($selectclassquery)) {
                    echo "<tr>
                    <td>".$row['year']."</td>
                    <td>".$row['dept']."</td>
                    <td>".$row['division']."</td>
                    <td><a href='' style='color: blue'><img src='https://img.icons8.com/color/25/000000/delete-forever.png'/></a> <a href=''><img src='https://img.icons8.com/fluent/23/000000/edit.png'/></a></td>
                </tr>";
                }
            }
            ?>
            </table>
            
        </div>
    </div>
</div>
<?php include'footer.php' ?>