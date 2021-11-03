<?php
include  $_SERVER['DOCUMENT_ROOT']."/api/mysql.php";

$device_id = $_GET['device_id'];

$sql = query("SELECT * FROM $device_id ORDER BY Date DESC LIMIT 1");

while($result = $sql->fetch_array())
{
    if($result["AirScore"] != null) {
        $json = ['target_device' => $result["DEVICE_ID"], 
        'online' => "true",
        'date' => $result["Date"]];
    }else{
        $json = ['target_device' => "Unknown", 
        'online' => "false",
        'date' => "Unknown"];
    }

    header('Content-type: application/json'); 
    echo json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}
mysqli_close($conn);

?>