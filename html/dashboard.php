<?php session_start();
include('../db/dbConn.php');
// Check if the 'username' session variable is set, indicating a logged-in session
if (!isset($_SESSION['user_id'])) {

    if ($_SESSION['role'] != 'admin') {
        header('Location:../index.html');

    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Dyuni SHS</title>
    <meta name="description"
        content="The Daeyang Student Hospital System is a digital healthcare system for students which will help them when accessing medical services by providing a trusted and secure patient information for medical treatment. The core purpose of this system is to eliminate the use of the hospital slips.">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0"
            style="color: var(--bs-navbar-color);background: #af7505;">
            <div class="container-fluid d-flex flex-column p-0"><a
                    class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#"><i
                        class="far fa-star" data-bss-hover-animate="shake" style="font-size: 39px;"></i>
                    <div class="sidebar-brand-icon rotate-n-15"></div>
                    <div class="sidebar-brand-text mx-3"><span
                            style="font-family: Nunito, sans-serif;font-size: 16px;">Daeyang SHS</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link active" href="dashboard.php"><i
                                class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="profile.html"><i class="fas fa-user"></i><span
                                style="font-weight: bold;">User Mgmt</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="table.php"><i class="fas fa-table"></i><span
                                style="font-weight: bold;">Users</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="../php/logout.php"><i
                                class="fas fa-user-circle"></i><span style="font-weight: bold;">Log Out</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0"
                        id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">

                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Dashboard</h3>
                    </div>
                    <div class="row">
                        <?php
                        $sql = "SELECT COUNT(stuff.stuff_id) as stuff_count , COUNT(Students.student_id) as  student_count FROM users LEFT JOIN Students ON Students.user_id = users.user_id LEFT JOIN stuff ON stuff.user_id = users.user_id WHERE users.archived = 0";
                        $result = $conn->query($sql);
                        $res = $result->fetch_assoc();
                        ?>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span
                                                    style="color: #af7505;">no of Employees</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>
                                                    <?php echo $res['stuff_count'] ?>
                                                </span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-success py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span
                                                    style="color: #af7505;">No of students</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>
                                                    <?php echo $res['student_count'] ?>
                                                </span></div>
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                      

                    </div>
                    <div class="row">
                        <div class="col-lg-7 col-xl-12">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="text-primary fw-bold m-0"
                                        style="--bs-primary: #af7505;--bs-primary-rgb: 175,117,5;">No. of Hospital Visit
                                        per Month</h6>
                                    <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle"
                                            aria-expanded="false" data-bs-toggle="dropdown" type="button"><i
                                                class="fas fa-ellipsis-v text-gray-400"></i></button>
                                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                                            <p class="text-center dropdown-header">dropdown header:</p><a
                                                class="dropdown-item" href="#">&nbsp;Action</a><a class="dropdown-item"
                                                href="#">&nbsp;Another action</a>
                                            <div class="dropdown-divider"></div><a class="dropdown-item"
                                                href="#">&nbsp;Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div style="--bs-primary: #af7505;--bs-primary-rgb: 175,117,5;">
                                        <canvas style="width:100vh;height:30vh;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span style="color: #af7505;">Copyright © Dyuni SHS
                            2023</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>   
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

    <script src="../dashboard.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>