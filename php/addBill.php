
<?php
session_start(); // Start or resume the session
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../db/dbConn.php");
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the form
    $regNumber = $_POST["reg_number"];
    $serviceName = $_POST["ServiceName"];
    $serviceAmount = $_POST["serviceamount"];
    $medicationName = $_POST["medicationname"];
    $medicationAmount = $_POST["medicationamount"];

    $sql = "INSERT INTO `records`( `reg_number`, `service_amount`, `service_name`, `medication_amount`, `medication_name`) VALUES (?,?,?,?,?)"
    ;
    $stmt =   $conn->prepare($sql);
    $stmt->bind_param("sssss", $regNumber, $serviceAmount, $serviceName,$medicationAmount,$medicationName)
;
if($stmt->execute()){
    $result = $stmt->insert_id;
    header("Location:../html/Billpayment.php?id=$result");
}
}
?>
