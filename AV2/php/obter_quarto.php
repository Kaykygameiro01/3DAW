<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$host = "localhost";
$user = "root";
$password = "";
$database = "hostel_app";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
  die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

if (isset($_GET['id'])) {
  $roomId = $_GET['id'];

  $sql = "SELECT * FROM rooms WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $roomId);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $room = $result->fetch_assoc();
    echo json_encode($room);
  } else {
    echo json_encode(["error" => "Quarto não encontrado."]);
  }

  $stmt->close();
}

$conn->close();
