<html>
<head>
    <title>Manage Classes</title>
    <link rel="stylesheet" href="common.css">
    <?php include'../link.php' ?>
    <style type="text/css">
    </style>
    </head>
<body>
<?php
    session_start();
    if(isset($_POST['deleteclass'])){
        $class = $_POST['deleteclass'];
        $delete = "delete from class where class_id = '$class'";
        $delete_query = mysqli_query($conn, $delete);
        if($delete_query){
            $_SESSION['delete'] = "Class deleted successfully";
        }
        else{
            $_SESSION['deletenot'] = "Error!! Class not deleted.";
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
                        <a href="add_class.php" class="active_link"><img src="https://img.icons8.com/ios-filled/26/ffffff/google-classroom.png"/> Classes</a>
                    </li>
                    <li>
                        <a href="add_student.php"><img src="https://img.icons8.com/ios-filled/25/ffffff/student-registration.png"/> Students</a>
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
            </button><span class="page-name"> Manage Classes</span>
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
        if(isset($_SESSION['class'])){
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>".$_SESSION['class']."<button class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            unset($_SESSION['class']);
        }
        if(isset($_SESSION['classnot'])){
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>".$_SESSION['classnot']."<button class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            unset($_SESSION['classnot']);
        }

        if(isset($_SESSION['delete'])){
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>".$_SESSION['delete']."<button class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['deletenot'])){
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>".$_SESSION['deletenot']."<button class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            unset($_SESSION['deletenot']);
        }


        ?>
      
    <div class="table-responsive border">
            <table class="table table-hover text-center">
                <thead class="thead-light">
                    <tr>
                        <th>Year</th>
                        <th>Department</th>
                        <th>Division</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="addclass.php" method="post">
                     <tr>
                        <th class="py-3 bg-light">
                            <select id="year" name="year" class="form-control">
                                <option value="">--select--</option>
                                <option value="FE">FE</option>
                                <option value="SE">SE</option>
                                <option value="TE">TE</option>
                                <option value="BE">BE</option>
                            </select>
                        </th>
                        <th class="py-3 bg-light">
                            <select id="dept" name="dept" class="form-control">
                                <option value="">--select--</option>
                                <option value="Computer">Computer</option>
                                <option value="IT">IT</option>
                                <option value="EXTC">EXTC</option>
                                <option value="ETRX">ETRX</option>
                            </select>
                        </th>
                        <th class="py-3 bg-light">
                            <select id="div" name="div" class="form-control">
                                <option value="">--select--</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                        </th>
                        <th class="py-3 bg-light">
                            <button class="btn btn-primary" name="addclass">Add</button>
                        </th>
                    </tr>  
                </form>
                <?php
                $selectclass = "Select * from class order by year, dept, division";
                $selectclassquery = mysqli_query($conn, $selectclass);
                if($selectclassquery){
                    while ($row = mysqli_fetch_assoc($selectclassquery)) {
                        echo "<tr>
                        <td>".$row['year']."</td>
                        <td>".$row['dept']."</td>
                        <td>".$row['division']."</td>
                        <form method='post'>
                        <td>
                            <button class='btn btn-light px-1 py-0' type='submit' value='".$row['class_id']."' name='deleteclass'>
                                <img src='https://img.icons8.com/color/25/000000/delete-forever.png'/>
                            </button>
                        </td>
                        </form>
                    </tr>";
                    }
                }
                else{
                    echo "<tr><td>No classes available.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>
<?php include'footer.php' ?>
<script type="text/javascript">
   
</script>