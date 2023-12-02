<?php
include("../db/dbConn.php");
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $user_id = $_GET['user_id'];
    $sql = "UPDATE `users` SET `archived`= 0 WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    if($stmt->affected_rows > 0){
        http_response_code(200);
    }
     


}
?>