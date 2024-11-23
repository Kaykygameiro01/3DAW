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

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['reservation_id'])) {
  $reservation_id = intval($_GET['reservation_id']);

  $sql = "
        SELECT reservations.*, rooms.type, rooms.description
        FROM reservations
        JOIN rooms ON reservations.room_id = rooms.id
        WHERE reservations.id = ?
    ";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $reservation_id);

  if ($stmt->execute()) {
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    echo json_encode($data);
  } else {
    echo json_encode(["error" => "Erro ao buscar detalhes da reserva: " . $stmt->error]);
  }

  $stmt->close();
} else {
  echo json_encode(["error" => "Parâmetros inválidos"]);
}

$conn->close();
