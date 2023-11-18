
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
 
    $email = filter_var( $email, FILTER_SANITIZE_EMAIL);
    // SQL query to check if the provided username and password exist in the database
    $sql = "SELECT  users.user_id ,stuff.email,users.role ,stuff.password  FROM users INNER JOIN stuff ON stuff.user_id =  users.user_id WHERE stuff.email = '$email'" ;

    // Execute the query
    $result = mysqli_query($connection, $sql);

    // Check if there is a match
    if (mysqli_num_rows($result) == 1) {
         $result = mysqli_fetch_assoc($result);
              $url =  '../php/receptionist.php';
              if($result ['role'] == 'dos') {
$url = '../html/medicalrecords.php';
              }
              else if( $result ['role'] == 'admin') {
                $url = '../html/dashboard.php';

              }
             

        $fetchedPassword =  $result['password'];
        if($fetchedPassword != null){


      if(password_verify($password,$fetchedPassword) == true){
        $expire  =  mktime(1) + (1000*60*60);
        $_SESSION['user_id'] = $result['user_id'];
        $_SESSION['role'] = $result['role'];

        header("Location:$url");

      }else{
       header("Location: ../html/login.html?error= Password doesn`t match.");

      }
        }
        else{
            $user_id = $result['user_id'];
            header("Location:../html/setpassword.html?uid=$user_id");
        }

        exit();
    } else {
      
        // Login failed, redirect back to the login page with an error message
       header("Location: ../html/login.html?error=Invalid credentials. Please try again.");
        exit();
    }
}
?>
