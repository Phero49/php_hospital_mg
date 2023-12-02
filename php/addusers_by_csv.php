<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../db/dbConn.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded
    if (isset($_FILES["csv"]) && $_FILES["csv"]["error"] == UPLOAD_ERR_OK) {
        // Get the uploaded file
        $csvFile = $_FILES["csv"]["tmp_name"];
        $role = $_POST['role'];

        // Read the CSV file
        $csvData = array_map('str_getcsv', file($csvFile));

        // Extract and remove the header row
       $headers = array_shift($csvData);

        // Initialize an empty array to store the associative data
        $assocData = [];

        // Build the associative array
        foreach ($csvData as $row) {
            $assocRow = [];
            foreach ($headers as $index => $header) {
                if (isset($row[$index])) {
                    $assocRow[$header] = $row[$index];
                }
            }
            $assocData[] = $assocRow;
        }

        // Display the associative array
        for ($i = 0; $i < count($assocData); $i++) {
            $row = $assocData[$i];
        if(count($row) > 0){
              try {
                // Start a transaction
                $conn->begin_transaction();
            
                $regNumber = $row['reg_number'];
                $firstName = $row['first_name'];
                $enrollment = $row['enrollment'];
                $lastName = $row['last_name'];
                $phoneNumber = $row['phone_number'];
                $email = $row['email'];
                $dateofbirth = date_create($row['birthday']);
            
                $dob = date_format($dateofbirth, 'Y/n/j');
                $dateofbirth = $dob;
            
                $department = $row['department'];
                $gender = $row['gender'];
                $avatar = null;
            
                $res = $conn->query("SELECT `email` FROM `user_contact` WHERE email = '$email'");
                if ($res->num_rows == 0) {
                    $sql = "INSERT INTO users (role, avatar, first_name, last_name, gender, dob)
                            VALUES ('$role',?,?,?,?, ?)";
                    $stmt = $conn->prepare($sql);
                    // Bind parameters
                    $stmt->bind_param('sssss', $avatar, $firstName, $lastName, $gender, $dateofbirth);
            
                    if ($stmt->execute()) {
                        $stmt->close();
                        $id = "SELECT `user_id` FROM users WHERE created_on > NOW() - INTERVAL 1 SECOND AND first_name = '$firstName' AND last_name = '$lastName' AND dob='$dateofbirth' ; ";
                        $result = $conn->query($id);
            
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $user_id = $row["user_id"];
              if ($role == 'student') {
                                $insertStudentData =  "INSERT INTO `Students`(`reg_number`, `user_id`, `enrollment_year`, `faculty`) VALUES ( '$regNumber', '$user_id', '$enrollment', '$department')";
                                $result = $conn->query($insertStudentData) ;
                                if ($result == true) {
                               //   echo "<hr/>inserted fine <br/>  $user_id <br/><hr/>" ;

                                   
                                } else {
                                    // Rollback the transaction on failure
                                    $conn->rollback();
                                    echo "Failed to insert student data.";
                                }
                            } else {
                               $conn->rollback();
                            }
                            $contactQuery  =  "INSERT INTO `user_contact`( `user_id`, `phone_number`, `email`) VALUES (?,?,?)";
                            $stmt1 = $conn->prepare($contactQuery);
                            $stmt1->bind_param("sss", $user_id, $phoneNumber, $email);
                            $stmt1->execute();
                            $stmt1->close();
            
                          
                        }
                    }
                    else{
                     //   echo "filed $firstName";
                    }
                }
            
                // Commit the transaction if all queries were successful
                $conn->commit();
            } catch (\Throwable $th) {
                // Rollback the transaction on any exception
                $conn->rollback();
                throw $th;
            }
        }
          
            
        
        }
       header("Location:../html/table.php?role=$role");
    } else {
        echo "Error uploading file.";
    }
}

?>
