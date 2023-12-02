<?php
session_start(); // Start or resume the session
error_reporting(E_ALL);
ini_set('display_errors', 1);
require('../db/dbConn.php');
// Check if the 'username' session variable is set, indicating a logged-in session
if (!isset($_SESSION['user_id'])) {
    header('Location:../index.html');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Verification</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
</head>

<body class=" h-100">
    <div class="row">
        <div class="col-md-3 text-white" style="background-color: #af7503" id="sidBar">
            <div class="d-flex flex-column h-100 justify-content-between p-5" style="min-height: 100vh">
                <div>
                    <div class="mb-4">
                        <h5 style="margin-bottom: 3px">Welcome back</h5>
                        <div class="text-bold">
                            <h3 style="margin-top: 3px" class="text-bold">
                                <?php
                                $user_id = $_SESSION['user_id'];
                                $sql = "SELECT CONCAT(  first_name, ' ', last_name) as fullName FROM users WHERE user_id = '$user_id'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                $name = $row["fullName"];
                                echo $name

                                    ?>
                            </h3>
                        </div>
                    </div>
                </div>

             
                <div class="d-grid gap-3">
                
                    <button class="btn text-white" type="button">
                        <a href="./logout.php">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                                    <path fill-rule="evenodd"
                                        d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                                </svg>
                            </span>
                            Logout

                        </a>

                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-9" style="padding-left: 1px;">
            <div class="" style="background-color: #af7503; padding: 20px; border-radius: 5px">
            
            </div>
            <div class=" text-center">
                <div class="row align-items-center justify-content-center" style="margin:0px">
                    <div class="row " style="max-width: 400px; margin-top: 15vh">
                        <?php
                        // Assuming you have already established a database connection in $conn
                        
                        // Define the SQL query
                        $query = "SELECT student_id, reg_number,users.avatar, users.user_id,
                             graduation_year, enrollment_year,
                              users.first_name , users.last_name ,faculty
                               ,uc.phone_number ,uc.email ,users.dob FROM Students INNER JOIN users ON users.user_id = Students.user_id INNER JOIN user_contact uc ON uc.user_id = users.user_id  WHERE  reg_number  = ?;";

                        // The parameter to be bound in the query
                        $regNumber = $_GET['search']; // Replace with the actual registration number
                        
                        // Prepare the query
                        $stmt = $conn->prepare($query);

                        if ($stmt) {
                            // Bind the parameter and execute the query
                            $stmt->bind_param("s", $regNumber); // Assuming 'reg_number' is a string
                            $stmt->execute();

                            // Bind the results to variables
                        
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                ?>
                                <div class="d-flex justify-content-center pb-5">
                                    <div class=" text-center p-4">
                                        <img src="<?php echo $row['avatar'] ?>" alt="" class="rounded-circle mb-3 mt-4"
                                            width="160px" height="160px">
                                    </div>
                                </div>
                                <?php




                                echo "<div class='d-flex justify-content-between mb-2'>";
                                echo "<div><strong>Registration Number:</strong></div><div>{$row['reg_number']}</div>";
                                echo "</div>";


                                echo "<div class='d-flex justify-content-between mb-2'>";
                                echo "<div><strong>Enrollment Year:</strong></div><div>{$row['enrollment_year']}</div>";
                                echo "</div>";
                                echo "<div class='d-flex justify-content-between mb-2'>";
                                echo "<div><strong>First Name:</strong></div><div>{$row['first_name']}</div>";
                                echo "</div>";
                                echo "<div class='d-flex justify-content-between mb-2'>";
                                echo "<div><strong>Last Name:</strong></div><div>{$row['last_name']}</div>";
                                echo "</div>";
                                echo "<div class='d-flex justify-content-between mb-2'>";
                                echo "<div><strong>Faculty:</strong></div><div>{$row['faculty']}</div>";
                                echo "</div>";
                                echo "<div class='d-flex justify-content-between mb-2'>";
                                echo "<div><strong>Phone Number:</strong></div><div>{$row['phone_number']}</div>";
                                echo "</div>";
                                echo "<div class='d-flex justify-content-between mb-2'>";
                                echo "<div><strong>Email:</strong></div><div>{$row['email']}</div>";
                                echo "</div>";
                                echo "<div class='d-flex justify-content-between mb-2'>";
                                echo "<div><strong>Date of Birth:</strong></div><div>{$row['dob']}</div>";
                                echo "</div>";

                            } else {
                                echo "No records found for the provided registration number.";
                            } ?>

                            <?php

                            // Close the statement
                            $stmt->close();
                        } else {
                            echo "Error in preparing the query: " . $conn->error;
                        }

                        // Close the database connection
                        $conn->close();
                        ?>



                        <div class="my-2">
                            <?php

                            if(isset($row['reg_number'] )){
?>

                            <button type="button" class="btn btn-primary px-5">
                                <a href="../html/paymentform.html?reg_num=<?php echo $row['reg_number'] ?>"
                                    class="nav-link">Proceed</a>
                            </button>
                            
                           <?php }?>
                            <button type="button" class="btn btn-dark px-5" onclick="
                                window.history.back()

                            ">Back</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
    <script src="./script.js"></script>
</body>

</html>