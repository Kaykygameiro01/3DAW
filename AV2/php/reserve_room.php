<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Conexão com o banco de dados
$host = "localhost";
$user = "root";
$password = "";
$database = "hostel_app";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
  die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Lógica para reservar o quarto
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id'])) {
  $roomId = $data['id'];

  $sql = "UPDATE rooms SET status = 'occupied' WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $roomId);

  if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Reserva confirmada com sucesso!"]);
  } else {
    echo json_encode(["success" => false, "error" => "Erro ao atualizar status do quarto."]);
  }

  $stmt->close();
} else {
  echo json_encode(["success" => false, "error" => "ID do quarto não fornecido."]);
}

$conn->close();
