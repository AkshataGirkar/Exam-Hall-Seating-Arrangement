<?php
session_start();
?>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="common.css">
    <?php include'../link.php' ?>
    </head>
<body>
<?php
    if(isset($_POST['deletebatch'])){
        $batch = $_POST['deletebatch'];
        $delete = "delete from batch where batch_id = '$batch'";
        $delete_query = mysqli_query($conn, $delete);
        if($delete_query){
            $_SESSION['delbatch'] = "Allotment deleted successfully";
        }
        else{
            $_SESSION['delnotbatch'] = "Error!! Allotment not deleted.";
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
                        <a href="add_room.php"><img src="https://img.icons8.com/metro/25/ffffff/building.png"/> Rooms</a>
                    </li>
                    <li>
                        <a href="dashboard.php" class="active_link"><img src="https://img.icons8.com/nolan/30/ffffff/summary-list.png"/> Allotment</a>
                    </li>
                </ul>
            </nav>
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <img src="https://img.icons8.com/ios-filled/19/ffffff/menu--v3.png"/>
                    </button><span class="page-name"> Allotment</span>
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
        if(isset($_SESSION['batch'])){
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>".$_SESSION['batch']."<button class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            unset($_SESSION['batch']);
        }
        if(isset($_SESSION['batchnot'])){
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>".$_SESSION['batchnot']."<button class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            unset($_SESSION['batchnot']);
        }

        if(isset($_SESSION['delbatch'])){
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>".$_SESSION['delbatch']."<button class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            unset($_SESSION['delbatch']);
        }
        if(isset($_SESSION['delnotbatch'])){
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>".$_SESSION['delnotbatch']."<button class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            unset($_SESSION['delnotbatch']);
        }
        ?>
            <div class="table-responsive border">
                <table class="table table-hover text-center">
                        <thead class="thead-light">
                            <tr>
                                <th>Room & Floor</th>
                                <th>Class</th>
                                <th>Start Roll No.</th>
                                <th>End Roll No.</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="addallot.php" method="post">
                           <tr>
                                <th class="py-3 bg-light">
                                    <select name="room" class="form-control">
                                        <?php
                                        $select_rooms = "SELECT rid, room_no, floor, capacity, sum(total) as filled from batch right JOIN room on batch.room_id=room.rid group by rid";
                                        $select_rooms_query = mysqli_query($conn, $select_rooms);
                                        if(mysqli_num_rows($select_rooms_query)>0){
                                            echo "<option>--select--</option>";
                                            while($row = mysqli_fetch_assoc($select_rooms_query)){

                                                if($row['capacity']>$row['filled']){
                                                    echo "<option value=\"". $row['rid']."\">Room-".$row['room_no']." & Floor-".$row['floor']." </option>";
                                                }
                                            }
                                        } 
                                        else{
                                            echo "<option>No Rooms</option>";
                                        }
                                        ?>
                                        
                                    </select>
                                </th>
                                <th class="py-3 bg-light">
                                    <select id="sem" name="class" class="form-control">
                                    <?php 
                                        $selectclass = "select * from class order by year, dept, division";
                                        $selectclassQuery = mysqli_query($conn, $selectclass);
                                        if($selectclassQuery){
                                            echo "<option>--select--</option>";
                                            while($row = mysqli_fetch_assoc($selectclassQuery)){
                                               echo "<option value=".$row['class_id'].">".$row['year']." ".$row['dept']." ".$row['division']."</option>";
                                            }
                                        }
                                        else{
                                            echo "<option value='No options'>no</option>";
                                        }
                                    ?>
                                    </select>
                                </th>
                                <th class="py-3 bg-light"><input type="number" name="start" class="form-control" size=4></th>
                                <th class="py-3 bg-light"><input type="number" name="end" class="form-control" size=4></th>
                                <th class="py-3 bg-light"></th>
                                <th class="py-3 bg-light"><button class="btn btn-info form-control" name="addallotment">Add</button></th>
                            </tr> 
                            </form>    
                <?php
                $selectclass = "SELECT * FROM batch, class, room where rid=room_id and class.class_id=batch.class_id";
                $selectclassquery = mysqli_query($conn, $selectclass);
                if($selectclassquery){
                    while ($row = mysqli_fetch_assoc($selectclassquery)) {
                        echo "<tr>
                        <td>Room-".$row['room_no']." & Floor-".$row['floor']."</td>
                        <td>".$row['year']."-".$row['dept']."-".$row['division']."</td>
                        <td>".$row['startno']."</td>
                        <td>".$row['endno']."</td>
                        <td>".$row['total']."</td>
                        <form method='post'>
                        <td><button class='btn btn-light px-1 py-0' type='submit' value='".$row['batch_id']."' name='deletebatch'>
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