<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../db/dbConn.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded
    if (isset($_FILES["csv"]) && $_FILES["csv"]["error"] == UPLOAD_ERR_OK) {
        // Get the uploaded file
        $csvFile = $_FILES["csv"]["tmp_name"];

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
        foreach ($assocData as $row) {
            foreach ($row as $key => $value) {
            echo $key;
                
                $regNumber = $row['reg_number'];
                $firstName = $row['first_name'];
                $enrollment =$row['enrollment'];
                $lastName = $row['last_name'];
                $phoneNumber = $row['phone_number'];
                $email = $row['email'];
                $dateofbirth = $row['birthday'];
              
                $department = $row['department'];
                $role = $row['role'];
                $gender = $row['gender'];
                $avatar = null;
                $conn->begin_transaction();

                $sql = "INSERT INTO users (role, avatar, first_name, last_name, gender, dob)
                VALUES ('student',?,?,?,?, STR_TO_DATE(?, '%m/%d/%Y'))";
                $stmt = $conn->prepare($sql);

                // Bind parameters
                $stmt->bind_param('sssss', $avatar, $firstName,$lastName,$gender,$dateofbirth); // Assuming faculty corresponds to the gender or role in your case
              
             if(  $stmt->execute() == true){
            $id =  "SELECT `user_id` FROM users WHERE created_on > NOW() - INTERVAL 5 SECOND;";
            
            $result = $conn->query( $id);
            
            if( $result->num_rows > 0 ){
                
                $row = $result->fetch_assoc();
                $user_id = $row["user_id"];
            
                $contactQuery  =  "INSERT INTO `user_contact`( `user_id`, `phone_number`, `email`) VALUES (?,?,?)";
                $insertStudentData =  "INSERT INTO `Students`(`reg_number`, `user_id`, `graduation_year`, `enrollment_year`, `faculty`) VALUES (?,?,?,?,?)";
                $stmt = $conn->prepare($contactQuery);
                $stmt->bind_param("sss",$user_id,$phoneNumber,$email);
                $stmt->execute();
                $stmt = $conn->prepare($insertStudentData);
                $stmt->bind_param("sssss",$regNumber,$user_id,$graduationyear,$enrollment,$department);
               
                $stmt->execute();
            
            }
        }
            }
            echo "<br>";
        }
    } else {
        echo "Error uploading file.";
    }
}

?>
