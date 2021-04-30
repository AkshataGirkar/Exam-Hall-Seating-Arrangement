<?php 
session_start();
?>
<html>
<head>
    <title>Manage Rooms</title>
    <link rel="stylesheet" href="common.css">
    <?php include'../link.php' ?>
    <style type="text/css">
    </style>
    </head>
<body>
<?php
    if(isset($_POST['deleteroom'])){
        $room = $_POST['deleteroom'];
        $delete = "delete from room where rid = '$room'";
        $delete_query = mysqli_query($conn, $delete);
        if($delete_query){
            $_SESSION['delroom'] = "Room deleted successfully";
        }
        else{
            $_SESSION['delnotroom'] = "Error!! room not deleted.";
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
                    <a href="add_student.php"><img src="https://img.icons8.com/ios-filled/25/ffffff/student-registration.png"/> Students</a>
                </li>
                <li>
                    <a href="add_room.php" class="active_link"><img src="https://img.icons8.com/metro/26/ffffff/building.png"/> Rooms</a>
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
                </button><span class="page-name"> Manage Rooms</span>
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
        <div class="main-content">
            <?php
            if(isset($_SESSION['room'])){
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>".$_SESSION['room']."<button class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                unset($_SESSION['room']);
            }
            if(isset($_SESSION['roomnot'])){
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>".$_SESSION['roomnot']."<button class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                unset($_SESSION['roomnot']);
            }

            if(isset($_SESSION['delroom'])){
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>".$_SESSION['delroom']."<button class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                unset($_SESSION['delroom']);
            }
            if(isset($_SESSION['delnotroom'])){
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>".$_SESSION['delnotroom']."<button class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                unset($_SESSION['delnotroom']);
            }
            ?>

            <div class="table-responsive border">
                <table class="table table-hover text-center">
                       <thead class="thead-light">
                        <tr>
                            <th>Room No.</th>
                            <th>Floor</th>
                            <th>Capacity</th>
                            <th>Vacancy</th>
                            <th>Actions</th>
                        </tr>   
                        </thead>
                        <tbody>
                        <form action="addroom.php" method="post">
                        <tr>
                            <th class="py-3 bg-light">
                                <input class="form-control" type="number" min=0 max=815 name="roomno"></
                            </th>
                            <th class="py-3 bg-light">
                                <input class="form-control" type="number" min=0 max=8 name="floor">
                            </th>
                            <th class="py-3 bg-light">
                                <input class="form-control" type="number" min=0 max=80 name="cap">
                            </th>
                            <th class="py-3 bg-light"></th>
                            <th class="py-3 bg-light">
                                <button class="btn btn-primary" name="addroom">Add</button>
                            </th>
                        </tr>  
                    </form>
                        <?php
                        $selectclass = "SELECT rid, room_no, floor, capacity, sum(total) as filled from batch right JOIN room on batch.room_id=room.rid group by rid";
                        $selectclassquery = mysqli_query($conn, $selectclass);
                        if($selectclassquery){
                            while ($row = mysqli_fetch_assoc($selectclassquery)) {
                                $vacancy = $row['capacity']-$row['filled'];
                                echo "<tr>
                                <td>".$row['room_no']."</td>
                                <td>".$row['floor']."</td>
                                <td>".$row['capacity']."</td>
                                <form action='display_allotment.php' method='post'>
                                <td>".$vacancy."
                                <button class='btn btn-light px-1 py-0' type='submit' value='".$row['rid']."' name='display'>See</button>
                                </td>
                                </form>
                                <td>
                                <form method='post'>
                                <button class='btn btn-light px-1 py-0' type='submit' value='".$row['rid']."' name='deleteroom'>
                                <img src='https://img.icons8.com/color/25/000000/delete-forever.png'/></button>
                                </form>
                                </td>
                            </tr>";
                            }
                        }
                        else{
                            echo "<tr><td colspan=5>No rooms available.</td></tr>";
                        }
                        ?>
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include'footer.php' ?>

