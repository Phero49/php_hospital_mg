<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../db/dbConn.php");
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $avatar = $_POST['avatar'];
    $studentID = $_POST["studentID"];
    $lastname = $_POST["lastname"];
    $useremail = $_POST["useremail"];
    $graduationyear = $_POST["graduationyear"];
    $dateofbirth = $_POST["dateofbirth"];
    $firstname = $_POST["firstname"];
    $phonenumber = $_POST["phonenumber"];
    $enrollmentyear = $_POST["enrollmentyear"];
    $faculty = $_POST["faculty"];  // Note: add name attribute to the select element
    $gender = $_POST["gender"];  // Note: add name attribute to the select element
$conn->begin_transaction();

$sql = "INSERT INTO users (role, avatar, first_name, last_name, gender, dob)
VALUES ('student',?,?,?,?,?)";

$stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param('sssss', $avatar, $firstname,$lastname,$gender,$dateofbirth); // Assuming faculty corresponds to the gender or role in your case
  
 if(  $stmt->execute() == true){
$id =  "SELECT `user_id` FROM users WHERE created_on > NOW() - INTERVAL 5 SECOND;";

$result = $conn->query( $id);

if( $result->num_rows > 0 ){
    $row = $result->fetch_assoc();
    $user_id = $row["user_id"];

    $contactQuery  =  "INSERT INTO `user_contact`( `user_id`, `phone_number`, `email`) VALUES (?,?,?)";
    $insertStudentData =  "INSERT INTO `Students`(`reg_number`, `user_id`, `graduation_year`, `enrollment_year`, `faculty`) VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($contactQuery);
    $stmt->bind_param("sss",$user_id,$phonenumber,$useremail);
    $stmt->execute();
    $stmt = $conn->prepare($insertStudentData);
    $stmt->bind_param("sssss",$studentID,$user_id,$graduationyear,$enrollmentyear,$faculty);
   
    $stmt->execute();

}
else {
    echo "error";
}
 } 


    // Commit the transaction
  $conn->commit();
header("location:../html/table.php");


} else {
}
?>
