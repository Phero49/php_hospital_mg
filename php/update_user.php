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
    $dateofbirth = $_POST["dateofbirth"];
    $firstname = $_POST["firstname"];
    $id = $_POST["id"];
    $phonenumber = $_POST["phonenumber"];
    $enrollmentyear = $_POST["enrollmentyear"];
    $faculty = $_POST["faculty"];  // Note: add name attribute to the select element
    $gender = $_POST["gender"];  // Note: add name attribute to the select element
    $conn->begin_transaction();

    $sql = "
    UPDATE users
    SET avatar = ?,
        first_name = ?,
        last_name = ?,
        gender = ?,
        dob = ?
    WHERE user_id = ?;
";

    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param('ssssss', $avatar, $firstname, $lastname, $gender, $dateofbirth,$id); // Assuming faculty corresponds to the gender or role in your case

    if ($stmt->execute() == true) {


        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row["user_id"];

            $contactQuery = "
    UPDATE user_contact
    SET phone_number = ?,
        email = ?
    WHERE user_id = ?;
";
            $insertStudentData = "
    UPDATE Students
    SET reg_number = ?,
        graduation_year = ?,
        enrollment_year = ?,
        faculty = ?
    WHERE user_id = ?;
";
            $stmt = $conn->prepare($contactQuery);
            $stmt->bind_param("sss", $phonenumber, $useremail ,$user_id);
            $stmt->execute();
            $stmt = $conn->prepare($insertStudentData);
            $stmt->bind_param("sssss", $studentID,  $graduationyear, $enrollmentyear, $faculty,$user_id,);

            $stmt->execute();

        } else {
            echo "error";
        }
    }


    // Commit the transaction
    $conn->commit();
    header("location:../html/table.php");


} else {
}
?>