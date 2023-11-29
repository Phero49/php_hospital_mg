<?php
session_start(); // Start or resume the session
error_reporting();
ini_set('display_errors', 1);
require('../db/dbConn.php');
// Check if the 'username' session variable is set, indicating a logged-in session
if (!isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] != 'dos') {

        header('Location:../index.html');
    }

}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Table - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-by-Moorcam.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0"
            style="background: #af7505;">
            <div class="container-fluid d-flex flex-column p-0"><a
                    class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-hospital"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>DYUNI SHS</span></div>
                </a><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"></div>
                    <div class="sidebar-brand-text mx-3"><span>dean of students</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="balancetable.php"><i
                                class="fas fa-table"></i>&nbsp;Balance Table</a><a class="nav-link active"
                            href="medicalrecords.php"><i class="fas fa-table"></i><span>&nbsp;Medical
                                Records</span></a><a class="nav-link" href="queryinput.html"><i
                                class="fas fa-table"></i><span>&nbsp;Query Inputs</span></a><a class="nav-link"
                            href="../php/logout.php"><i class="fas fa-table"></i>&nbsp;Log Out</a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0"
                        id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">

                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Medical Records</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold" style="color: #af7505;">Medical Info</p>
                        </div>
                        <div class="card-body">
                        <form action="./medicalrecords.php" method="get">

                          <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                                    </div><input type="search" name="user_name" id="medicalsearch" class="form-control form-control-sm"
                                        aria-controls="dataTable" placeholder="Search">
                                </div>
                                <div class="col-md-6">
                                    <div class="text-md-end dataTables_filter"  id="dataTable_filter"><input
                                            id="medicaldatesearch" name="date" class="form-select form-select-sm" placeholder="DATE"
                                            type="date"><label class="form-label"></label></div>
                                </div>
                            </div>

                        </form>   
                      
                            <div class="table-responsive table mt-2" id="dataTable" role="grid"
                                aria-describedby="dataTable_info">
                                
                   <?php

     
try {
        $sql = "SELECT CONCAT(users.first_name,' ',users.last_name) as name, records.reg_number,records.service_name ,DATE(records.date) as 'date' ,(records.service_amount + records.medication_amount) as cost FROM records INNER JOIN Students ON Students.reg_number = records.reg_number INNER JOIN users ON users.user_id = Students.user_id;"
                                        ;


                                        if(isset($_GET["user_name"])) {
                                            $userName = $_GET["user_name"];
                                            $arr = explode(' ', $userName);
                                            $firstname = '';
                                            $lastname = '';
if(count($arr) >= 2){
   $firstname =  $arr[0];
                                            $lastname = $arr[1];
}
                                         
                                         $sql =    "SELECT CONCAT(users.first_name,' ',users.last_name) as name, records.reg_number,records.service_name ,DATE(records.date) as 'date' ,(records.service_amount + records.medication_amount) as cost FROM records INNER JOIN Students ON Students.reg_number = records.reg_number
                                             INNER JOIN users ON users.user_id = Students.user_id WHERE first_name = '$firstname' AND last_name  = '$lastname';"
                                            ;
                                        }

                                       
                                        $result = $conn->query($sql);


if($result->num_rows > 0) {
?>                                                   
       <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Registration ID</th>
                                            <th>Services</th>
                                            <th>Date</th>
                                            <th>Cost (MWK)</th>
                                        </tr>
                                    </thead>
                                    <tbody> <?php
                                   while ($row = $result->fetch_assoc()) {  
?>
  <tr>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['reg_number'] ?></td>
                                            <td><?php echo $row['service_name'] ?>&nbsp;</td>
                                            <td><?php echo $row['date'] ?><br></td>
                                            <td><?php echo $row['cost'] ?></td>
                                        </tr>
<?php


                                   }

?>



                                   <tr></tr>
                                        <tr></tr>
                                    </tbody>
                                    <tfoot>
                                        <tr></tr>
                                    </tfoot>
                                </table>    <?php 
                                      }      else {

                                        echo " <h5 class='text-center'> no such record your looking for was fount in the database</h5>  ";
                                      }//code...
} catch (e) {
    //throw $th;
}        ?>

                                        

                                      
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © DyuniSHS 2023</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>