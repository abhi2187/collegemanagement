<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];

$sql = "DELETE FROM events WHERE No=$id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["message" => "Event deleted successfully"]);
} else {
    echo json_encode(["error" => $conn->error]);
}

$conn->close();
?>
