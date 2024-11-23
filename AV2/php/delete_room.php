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

if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {
  $room_id = intval($_GET['id']);
  $sql = "DELETE FROM rooms WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $room_id);

  if ($stmt->execute()) {
    echo json_encode(["message" => "Quarto excluído com sucesso!"]);
  } else {
    echo json_encode(["error" => "Erro ao excluir quarto: " . $stmt->error]);
  }

  $stmt->close();
}

$conn->close();
