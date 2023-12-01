<?php

include("../db/dbConn.php");

// Your SQL query
$sql = "SELECT COUNT(record_id) as count, MONTH(date) as month
FROM records
GROUP BY MONTH(date);";

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    // Fetch the results as an associative array
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Close the database connection
    $conn->close();

    // Convert the result to JSON and echo it
    echo json_encode($data);

    http_response_code(200);
} else {
    // If the query fails, echo an error message
    echo "Error: " . $sql . "<br>" . $conn->error;
}
