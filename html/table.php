<?php session_start() ;
// Check if the 'username' session variable is set, indicating a logged-in session
if (!isset($_SESSION['user_id'])) {

  if($_SESSION['role'] != 'admin'){
  header('Location:../index.html');

  }
} 

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    />
    <title>Table - Dyuni SHS</title>
    <meta
      name="description"
      content="The Daeyang Student Hospital System is a digital healthcare system for students which will help them when accessing medical services by providing a trusted and secure patient information for medical treatment. The core purpose of this system is to eliminate the use of the hospital slips."
    />
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap"
    />
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css"
    />
    <link rel="stylesheet" href="assets/css/untitled.css" />
  </head>

  <body id="page-top">


<div class="modal fade" id="uploadCsv" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">upload a csv file containing the user data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="card">
                   

                        <div class="mx-4 my-4">
                          <form action="../php/addusers_by_csv.php" method="post" enctype="multipart/form-data">
                            <div  class="my-4">
                              <label for="role"> select user type</label>
                              <select
                                class="form-select"
                                aria-label="Select user type "
                                id="role"
                                name="role"
                              >
                                <option selected value="student">
                                  Student
                                </option>
                                <option value="dos">DOS</option>
                                <option value="admin">Admin</option>
                                <option value="receptionist">
                                  Receptionist
                                </option>
                              </select>
                            </div>
                            <label for="file"> select csv file</label>

                            <input
                              type="file"
                              id="file"
                              name="csv"
                              accept="text/csv"
                              class="form-control"
                              placeholder="Select a csv file"
                            />

                            <div class="text-right my-4 modal-footer">
                              <button type="submit" class="btn btn-primary">submit</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>
                          </form>

                        </div>
                      </div>
      </div>
     
    </div>
  </div>
</div>

    <div id="wrapper">
      <nav
        class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0"
        style="color: var(--bs-navbar-color); background: #af7505"
      >
        <div class="container-fluid d-flex flex-column p-0">
          <a
            class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0"
            href="#"
            ><i
              class="far fa-star"
              data-bss-hover-animate="shake"
              style="font-size: 39px"
            ></i>
            <div class="sidebar-brand-icon rotate-n-15"></div>
            <div class="sidebar-brand-text mx-3">
              <span style="font-family: Nunito, sans-serif; font-size: 16px"
                >Daeyang SHS</span
              >
            </div>
          </a>
          <hr class="sidebar-divider my-0" />
          <ul class="navbar-nav text-light" id="accordionSidebar">
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php"
                ><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profile.html"
                ><i class="fas fa-user"></i
                ><span style="font-weight: bold">User Mgmt</span></a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="table.php"
                ><i class="fas fa-table"></i
                ><span style="font-weight: bold">Users</span></a
              >
            </li>

            <li class="nav-item">
              <a class="nav-link" href="../php/logout.php"
                ><i class="fas fa-user-circle"></i
                ><span style="font-weight: bold">Log Out</span></a
              >
            </li>
          </ul>
          <div class="text-center d-none d-md-inline">
            <button
              class="btn rounded-circle border-0"
              id="sidebarToggle"
              type="button"
            ></button>
          </div>
        </div>
      </nav>
      <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
          <div class="container-fluid">
            <h3 class="text-dark mb-4">Users</h3>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
              <div class="container-fluid justify-content-end">
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                  <div class="navbar-nav">
                    <!-- Vertically centered modal -->
                 

                    <div>
                      <button
                        data-bs-toggle="modal"
                        data-bs-target="#uploadCsv"
                        class="btn btn-primary"
                        role="button"
                        style="background: #af7505"
                      >
                        add new users
                      </button>
                    </div>
         
                  </div>

                  <div class="mx-3">
                  <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Select user types
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item active" href="./table.php?role=student">student</a></li>
    <li><a class="dropdown-item" href="./table.php?role=admin">admins</a></li>
    <li><a class="dropdown-item" href="./table.php?role=dos">dos</a></li>
    <li><a class="dropdown-item" href="./table.php?role=receptionist">receptionist</a></li>
  </ul>
</div>
                  </div>
                </div>
              </div>
            </nav>

            <div class="card shadow">
              <div class="card-header py-3">
                <p
                  class="text-primary fw-bold m-0"
                  style="--bs-primary: #af7505; --bs-primary-rgb: 175, 117, 5"
                >
                <?php 
                $role = 'student';
                if(isset($_GET['role'])){
$role = $_GET['role'];
                }
                
             echo $role;   ?>   Infomation
                </p>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6 text-nowrap">
                    <div
                      id="dataTable_length"
                      class="dataTables_length"
                      aria-controls="dataTable"
                    >
                      <label class="form-label"
                        >Show&nbsp;<select
                          class="d-inline-block form-select form-select-sm"
                        >
                          <option value="10" selected="">10</option>
                          <option value="25">25</option>
                          <option value="50">50</option>
                          <option value="100">100</option></select
                        >&nbsp;</label
                      >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div
                      class="text-md-end dataTables_filter"
                      id="dataTable_filter"
                    >
                      <label class="form-label"
                        ><input
                          type="search"
                          class="form-control form-control-sm"
                          aria-controls="dataTable"
                          placeholder="Search"
                      /></label>
                    </div>
                  </div>
                </div>
                <div
                  class="table-responsive table mt-2"
                  id="dataTable"
                  role="grid"
                  aria-describedby="dataTable_info"
                >
                  <table class="table my-0" id="dataTable">
                    <thead>
                      <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Role</th>
                        <th>Gender</th>
                        <th >ACTION</th>
                        <th >ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <?php
                    include('../db/dbConn.php');
                    
                    $sql = "SELECT `user_id`, `avatar`, `role`, `first_name`, `last_name`, `gender` FROM `users` WHERE role = '$role' ORDER BY created_on DESC LIMIT 0,30;";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
      
           ?>
                        <td>
                          <?php    ?>
                          <img
                            class="rounded-circle me-2"
                            width="30"
                            height="30"
                            src="<?php echo $row['avatar']   ?>"
                          /><?php echo $row['first_name']   ?>
                        </td>
                        <td><?php echo $row['last_name']   ?></td>
                        <td><?php echo $row['role']   ?></td>
                        <td><?php echo $row['gender']   ?></td>
                        <td>
                          <a
                            class="btn btn-primary"
                            role="button"
                            
                            style="background: #af7505; display: <?php echo $role == 'student' ? 'block' : 'none'; ?>;"
                            href="editProfile.php?uid=<?php echo $row['user_id'] ?>"
                            >EDIT</a
                          >
                        </td>
                        <td>
                          <button
                            id="<?php echo $row['user_id']  ?>"
                           
                            data-bs-toggle="modal"
                            data-bs-target="#exampleModal"
                            onclick="deleteUser(event,'<?php echo $row['first_name']   ?>','<?php echo $row['last_name']   ?>')"
                            class="btn btn-primary text-uppercase delete"
                            style="background: #af7505;"
                          >
                            Archive
                          </button>
                        </td>
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

        <div
          class="modal fade"
          id="exampleModal"
          tabindex="-1"
          aria-labelledby="exampleModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                  Modal title
                </h1>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body"></div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal"
                >
                  Close
                </button>
                <button
                  type="button"
                  class="btn btn-primary"
                  data-bs-dismiss="modal"
                  id="confirm-delete"
                >
                  delete
                </button>
              </div>
            </div>
          </div>
        </div>

        <footer class="bg-white sticky-footer">
          <div class="container my-auto">
            <div class="text-center my-auto copyright">
              <span style="color: #af7505">Copyright © Dyuni SHS 2023</span>
            </div>
          </div>
        </footer>
      </div>
      <a class="border rounded d-inline scroll-to-top" href="#page-top"
        ><i class="fas fa-angle-up"></i
      ></a>
    </div>
    <script src="../deleteuser.js"></script>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/theme.js"></script>
  </body>
</html>
