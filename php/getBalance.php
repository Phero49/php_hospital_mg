<?php

include('../db/dbConn.php');

$sql = "SELECT records.service_name, Month(records.date) as month,YEAR(records.date) as year, SUM(records.service_amount)+SUM(records.medication_amount)  as total   FROM records GROUP BY records.service_name;"
;
$result =    $conn->query($sql);
$months = array(
'January', 'February', 'March', 'April', 'May', 'June',
'July', 'August', 'September', 'October', 'November', 'December'
);

$rows = array();
while ($row = $result->fetch_assoc()) {
    array_push($rows,$row);
}



echo json_encode($rows);