<?php session_start();
include("../db/dbConn.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] != 'dos') {
        header('Location:../index.html');

    }
} ?>
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
                    <div class="sidebar-brand-text mx-3"><span>DEAN OF STUDENTS</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="medicalrecords.php"><i
                                class="fas fa-table"></i>&nbsp;Medical Records&nbsp;</a><a class="nav-link active"
                            href="balancetable.php"><i class="fas fa-table"></i><span>Balance</span></a><a
                            class="nav-link" href="queryinput.html"><i class="fas fa-table"></i><span>Query
                                Input</span></a><a class="nav-link" href=""><i
                                class="fas fa-table"></i><span>&nbsp;Log Out</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0"
                        id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
        
                <div class="container-fluid">
                    <div class="row flex-row">
                        <div class="col offset-xxl-0">
                            <h3 class="text-dark d-flex flex-row align-items-xxl-end mb-4" style="width: 500px;">Balance
                                Table</h3>
                        </div>
                        <div class="col offset-xxl-5"><button class="btn btn-primary align-items-xxl-end file"
                                id="reportgenerate" type="file" style="background: #af7505;" rel="file"
                                name="reportgenerate">Generate Report</button></div>
                    </div>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold" style="color: #af7505;color: #af7505;">Balance Info</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                                        <input type="search" id="balancesearch" class="form-control form-control-sm"
                                            aria-controls="dataTable" placeholder="Search"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-md-end dataTables_filter" id="dataTable_filter"><input
                                            id="balancedatesearch" class="form-select form-select-sm"
                                            placeholder="DATE"><label class="form-label"></label></div>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid"
                                aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Service&nbsp;</th>
                                            <th>Month</th>
                                            <th>Year</th>
                                            <th>Total (MK)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT records.service_name, Month(records.date) as month,YEAR(records.date) as year, SUM(records.service_amount)+SUM(records.medication_amount)  as total   FROM records GROUP BY records.service_name;"
                                        ;
                                      $result =    $conn->query($sql);
                                      $months = array(
                                        'January', 'February', 'March', 'April', 'May', 'June',
                                        'July', 'August', 'September', 'October', 'November', 'December'
                                    );
while ($row = $result->fetch_assoc()) {

    ?>
   <tr>
                                            <td><?php echo $row['service_name'] ?></td>
                                            <td><?php echo $months[ $row['month']-1] ?></td>
                                            <td><?php echo $row['year'] ?></td>
                                            <td><?php echo $row['total'] ?></td>
                                         
                                        </tr>

<?php }

                                        ?>
                                     
                                     
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
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>