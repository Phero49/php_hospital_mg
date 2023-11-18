<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//include_once("db/dbConn.php");

// Rest of your PHP code
// ...
?>
<?php

require('../db/dbConn.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Create a new DatabaseConnection instance

    // Get the database connection
    $connection = $conn;

    // Get the user's password and confirm password from the form
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];
    $user_id = $_POST["user_id"];
  
    $url = "../html/adminLogin.html";

    // Check if the passwords match
    if ($password === $confirmPassword) {
        // Hash the password using password_hash
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Perform database operations to insert the hashed password
     

        // Insert the hashed password into the database (replace 'users' and 'password_hash_column' with your actual table and column names)
        $query = "UPDATE `stuff` SET password= ? WHERE `user_id`= ? ";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("ss", $hashedPassword, $user_id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            // Password hashed and inserted successfully
            header("Location:$url")
            ;
        } else { 
            echo $user_id
            ?>
            <div>
                <h3> an error occurred make sure <a href="<?php $url ?>">login again</a>
                </h3>
            </div>
            <?php
          
        }

        // Close the database connection
        $connection->close();
    } else {
        // Passwords do not match
        echo "Passwords do not match. Please try again.";
    }
}
?>