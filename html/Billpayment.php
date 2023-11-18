<?php
session_start();
include("../db/dbConn.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user_id']) && $_SESSION['role'] == 'receptionist' ) {
    header('Location:../login.html');
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
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0"
            style="background: #af7505;">
            <div class="container-fluid d-flex flex-column p-0"><a
                    class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-hospital"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>dYuni SHS</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="paymentform.html"><i
                                class="fab fa-wpforms"></i><span>&nbsp;Bill Form</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="Billpayment.html"><i
                                class="fas fa-table"></i><span>Bill Details&nbsp;</span></a><a class="nav-link"
                            href="index.html"></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0"
                        id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3"
                            id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button></div>
                </nav>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Bill Details</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p style="color: #af7505;"><strong><span style="color: rgb(78, 115, 223);">Service
                                        Details</span></strong><br></p>
                        </div>
                        <div class="card-body">
                            <div class="row text-capitalize">
                                <?php
                                $id = $_GET['id'];
                                $sql = "SELECT  records.date as 'timestamp',
                              records.service_amount, CONCAT(users.first_name , ' ',users.last_name) as 
                              'student_name', records.service_name, records.medication_amount, 
                              records.medication_name FROM records INNER JOIN Students ON Students.reg_number = records.reg_number INNER JOIN users ON users.user_id = Students.user_id WHERE records.record_id = $id";
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
foreach ($row as $key => $value) {
    ?>

<div class="col-12 d-flex" style="padding-top: 10px;padding-bottom: 10px;"><label
                                        class="form-label"
                                        style="font-weight: bold;width: 200px;margin-left: 12px;height: 38px;">                                        <?php echo str_replace('_',' ',$key) ?>
 &nbsp;</label>
                                    <div>
                                        <?php echo $value ?>
                                    </div>
                                </div>

    <?php
}

                                    ?>
                               
                               
                            <div class="table-responsive table mt-2" id="dataTable" role="grid"
                                aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr></tr>
                                    </thead>
                                    <tbody>
                                        <tr></tr>
                                    </tbody>
                                    <tfoot>
                                        <tr></tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Dyuni SHS 2023</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>