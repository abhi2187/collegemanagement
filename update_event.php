<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'];
$name = $data['event_name'];
$organizer = $data['event_organizer'];
$date = $data['event_date'];
$place = $data['event_place'];

$sql = "UPDATE events SET Event_Name='$name', Event_Organizer='$organizer', Event_Date='$date', Event_Place='$place' WHERE No=$id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["message" => "Event updated successfully"]);
} else {
    echo json_encode(["error" => $conn->error]);
}

$conn->close();
?>
