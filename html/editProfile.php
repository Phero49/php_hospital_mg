<?php session_start();
include("../db/dbConn.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user_id'])) {
  if ($_SESSION['role'] != 'admin') {
    header('Location:../index.html');

  }
}

if (!isset($_GET['uid'])) {
  http_response_code(400);

  // Provide an error message (optional)
  echo "error 400 Bad Request: Missing required data.";

  // Stop further execution
  exit;
} ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
  <title>Profile - Dyuni SHS</title>
  <meta name="description"
    content="The Daeyang Student Hospital System is a digital healthcare system for students which will help them when accessing medical services by providing a trusted and secure patient information for medical treatment. The core purpose of this system is to eliminate the use of the hospital slips." />
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap" />
  <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />
  <link rel="stylesheet" href="assets/css/untitled.css" />
</head>

<body id="page-top">
  <div id="wrapper">
    <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0"
      style="color: var(--bs-navbar-color); background: #af7505">
      <div class="container-fluid d-flex flex-column p-0">
        <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#"><i
            class="far fa-star" data-bss-hover-animate="shake" style="font-size: 39px"></i>
          <div class="sidebar-brand-icon rotate-n-15"></div>
          <div class="sidebar-brand-text mx-3">
            <span style="font-family: Nunito, sans-serif; font-size: 16px">Daeyang SHS</span>
          </div>
        </a>
        <hr class="sidebar-divider my-0" />
        <ul class="navbar-nav text-light" id="accordionSidebar">
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="profile.html"><i class="fas fa-user"></i><span
                style="font-weight: bold">User Mgmt</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="table.php"><i class="fas fa-table"></i><span
                style="font-weight: bold">Users</span></a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="../php/logout.php"><i class="fas fa-user-circle"></i><span
                style="font-weight: bold">Log Out</span></a>
          </li>
        </ul>
        <div class="text-center d-none d-md-inline">
          <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
        </div>
      </div>
    </nav>
    <div class="d-flex flex-column" id="content-wrapper">
      <div id="content">
        <?php
        $uid = $_GET['uid'];
        $sql = "SELECT `first_name`,`last_name`,`gender`,`dob`,`avatar` ,s.reg_number,
                         uc.phone_number,uc.email ,s.graduation_year,s.faculty,s.reg_number
                          FROM users INNER JOIN user_contact as uc INNER JOIN Students as s 
                          WHERE users.user_id = '$uid';";
        $result = $conn->query($sql, );
        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();



          ?>
          <div class="container-fluid">
            <h3 class="text-dark mb-4">Edit Profile</h3>
            <div class="row mb-3">
              <div class="col-lg-4">
                <div class="card mb-3">
                  <div class="card-body text-center shadow">
                    <img id="avatar" class="rounded-circle mb-3 mt-4" src="<?php echo $row['avatar'] ?>" width="160"
                      height="160" />
                    <div class="mb-3">
                      <button class="btn btn-primary btn-sm" id="picupload" type=""
                        style="background: #af7505; border-color: #af7505" name="picsubmit">
                        Upload Picture
                      </button>
                    </div>
                  </div>
                </div>
                <div class="card shadow mb-4"></div>
              </div>
              <div class="col-lg-8">
                <div class="row mb-3 d-none">
                  <div class="col">
                    <div class="card text-white bg-primary shadow">
                      <div class="card-body">
                        <div class="row mb-2">
                          <div class="col">
                            <p class="m-0">Peformance</p>
                            <p class="m-0"><strong>65.2%</strong></p>
                          </div>
                          <div class="col-auto">
                            <i class="fas fa-rocket fa-2x"></i>
                          </div>
                        </div>
                        <p class="text-white-50 small m-0">
                          <i class="fas fa-arrow-up"></i>&nbsp;5% since last
                          month
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="card text-white bg-success shadow">
                      <div class="card-body">
                        <div class="row mb-2">
                          <div class="col">
                            <p class="m-0">Peformance</p>
                            <p class="m-0"><strong>65.2%</strong></p>
                          </div>
                          <div class="col-auto">
                            <i class="fas fa-rocket fa-2x"></i>
                          </div>
                        </div>
                        <p class="text-white-50 small m-0">
                          <i class="fas fa-arrow-up"></i>&nbsp;5% since last
                          month
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="card shadow mb-3">
                      <div class="card-header py-3">
                        <p class="text-primary fw-bold m-0" style="
                            --bs-primary: #af7505;
                            --bs-primary-rgb: 175, 117, 5;
                          ">
                          User Information&nbsp;
                        </p>
                      </div>
                      <div class="card-body">
                        <form method="post" action="../php/update_user.php">


                          <div class="row">
                            <div>
                              <input type="text" name="avatar" value="<?php echo $row['avatar']?>" id="avatarFiled" style="display: none;" />

                            </div>
                            <div class="col">
                              <div class="mb-3">
                                <label class="form-label" for="username"><strong>Student ID</strong><br /></label
                                ><input
                                  class="form-control" value=" <?php echo $row['reg_number']?>" type="text" id="studentID" placeholder="BscICT/00/00"
                                  name="studentID" />
                              </div>
                              <div class="mb-3">
                                <label class="form-label" for="username"><strong>Last Name</strong><br /></label>
                                <input
                                value="<?php echo $row['last_name']?>"
                                  class="form-control" type="text" id="lastname" placeholder="" name="lastname" />
                              </div>
                              <div class="mb-3">
                                <label class="form-label" for="username"><strong>Email
                                    Address&nbsp;</strong><br /></label><input class="form-control" type="email"
                                  id="useremail" value="<?php echo $row['email']?>" placeholder="user@mail.com" name="useremail" />
                              </div>

                              <div class="mb-3">
                                <label class="form-label" for="username"><strong>Date of
                                    Birth&nbsp;</strong><br /></label><input class="form-control" type="date"
                                  id="dateofbirth" value="<?php echo $row['dob']?>" placeholder="DD/MM/YYYY" name="dateofbirth" />
                              </div>
                            </div>
                            <div class="col">
                              <div class="mb-3">
                                <label class="form-label" for="email"><strong>First&nbsp;
                                    Name&nbsp;</strong><br /></label><input class="form-control" type="text"
                                  id="firstname" placeholder="" value=" <?php echo $row['first_name']?>" name="firstname" />
                              </div>
                              <div class="mb-3">
                                <label class="form-label" for="email"><strong>Phone
                                    Number&nbsp;</strong><br /></label><input class="form-control" type="tel"
                                  id="phonenumber" <?php echo $row['phone_number']?> placeholder="+265 000-00-000" name="phonenumber" maxlength="10" />
                              </div>
                              <div class="mb-3">
                                <label class="form-label" for="email"><strong>Enrollment Year</strong><br /></label><input
                                  class="form-control" id="enrollmentyear" value="<?php echo $row['graduation_year']?>" placeholder="YYYY" name="enrollmentyear"
                                  type="date" maxlength="4" min="2014" />
                              </div>
                              <div class="mb-3">
                                <label class="form-label" for="email"><strong>Faculty&nbsp;</strong><br /></label><select
                                  class="form-select"  id="faculty" name="faculty" >
                                  <optgroup label="Select Faculty ">

                                    <option value="BBA" selected="<?php echo $row['faculty']?>"><?php echo $row['faculty']?></option>
                                    <option value="BBA" >BBA</option>
                                    <option value="ICT">ICT</option>
                                    <option value="Nursing">Nursing</option>
                                  </optgroup>
                                </select>
                              </div>
                              <input value="<?php echo $uid ?> " name="id" style="display:none;">
                              <div class="mb-3">
                                <label class="form-label" for="email"><strong>Gender&nbsp;</strong><br /></label><select
                                  name="gender" class="form-select" id="faculty" aria-readonly>
                                  <optgroup label="Select Gender ">
                                    <option value="Male" selected="Male">
                                      Male
                                    </option>
                                    
                                    <option value="Male" selected="Male">
                                      Male
                                    </option>
                                    <option value="Female">
                                      Female
                                    </option>
                                  </optgroup>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="mb-3">
                            <button class="btn btn-primary btn-sm" type="submit"
                              style="border-color: #af7505; background: #af7505" name="userinfosubmit">
                              Save&nbsp;
                            </button>
                          </div>
                        <?php } else {
        } ?>
                      </form>
                    </div>
                  </div>
                  <div class="card shadow"></div>
                </div>
              </div>
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
    <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
  </div>

  <input type="file" id="pickFile" name="avatar" accept="image/*" style="display: none;" />

  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/theme.js"></script>
  <script src="../picupload.js"></script>
</body>

</html>