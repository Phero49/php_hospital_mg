
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Rest of your PHP code
// ...
?>

<?php
include("../db/dbConn.php");

// Create a new DatabaseConnection instance


// Get the database connection
$connection = $conn;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role =  $_POST["role"];
 
    $email = filter_var( $email, FILTER_SANITIZE_EMAIL);
    // SQL query to check if the provided username and password exist in the database
    $sql = "SELECT  users.user_id ,stuff.email ,stuff.password  FROM users INNER JOIN stuff ON stuff.user_id =  users.user_id WHERE stuff.email = '$email' AND users.role = 'admin'" ;

    // Execute the query
    $result = mysqli_query($connection, $sql);

    // Check if there is a match
    if (mysqli_num_rows($result) == 1) {
         $result = mysqli_fetch_assoc($result);
         
        $fetchedPassword =  $result['password'];
        if($fetchedPassword != null){


      if(password_verify($password,$fetchedPassword) == true){
        $expire  =  mktime(1) + (1000*60*60);
        $_SESSION['user_id'] = $result['user_id'];
        $_SESSION['role'] = 'admin';
        header('Location:../html/dashboard.php');

      }else{
       header("Location: ../html/adminLogin.html?error= Password doesn`t match.");

      }
        }
        else{
            $user_id = $result['user_id'];
            header("Location:../html/setpassword.html?uid=$user_id&role=$role");
        }

        exit();
    } else {
      
        // Login failed, redirect back to the login page with an error message
       header("Location: ../html/adminLogin.html?error=Invalid credentials. Please try again.");
        exit();
    }
}
?>
