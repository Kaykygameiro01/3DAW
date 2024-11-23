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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $room_id = $_POST['room_id'];
  $check_in = $_POST['check_in'];
  $check_out = $_POST['check_out'];
  $guests = $_POST['guests'];

  $sql = "INSERT INTO reservations (room_id, check_in, check_out, guests) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("issi", $room_id, $check_in, $check_out, $guests);

  if ($stmt->execute()) {
    echo json_encode(["message" => "Reserva feita com sucesso!"]);
  } else {
    echo json_encode(["error" => "Erro ao fazer reserva: " . $stmt->error]);
  }

  $stmt->close();
} else {
  echo json_encode(["error" => "Método não permitido"]);
}

$conn->close();
