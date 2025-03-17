<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

$name = $data['event_name'];
$organizer = $data['event_organizer'];
$date = $data['event_date'];
$place = $data['event_place'];

$sql = "INSERT INTO events (Event_Name, Event_Organizer, Event_Date, Event_Place) VALUES ('$name', '$organizer', '$date', '$place')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["message" => "Event added successfully"]);
} else {
    echo json_encode(["error" => $conn->error]);
}

$conn->close();
?>
