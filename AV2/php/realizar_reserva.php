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
  // Recebe os dados do formulário
  $room_id = $_POST['room_id'];
  $guest_name = $_POST['guest_name'];
  $guest_cpf = $_POST['guest_cpf'];
  $check_in = $_POST['check_in'];
  $check_out = $_POST['check_out'];
  $guests = $_POST['guests'];
  $card_number = $_POST['card_number'];
  $card_expiry = $_POST['card_expiry'];
  $card_cvv = $_POST['card_cvv'];

  // Validação (exemplo: certifique-se de que o número de hóspedes é válido)
  if ($guests < 1) {
    echo json_encode(["error" => "Número de hóspedes inválido"]);
    exit;
  }

  // Insere os dados na tabela de reservas
  $sql = "INSERT INTO reservations (room_id, guest_name, guest_cpf, check_in, check_out, guests, card_number, card_expiry, card_cvv) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("issssisss", $room_id, $guest_name, $guest_cpf, $check_in, $check_out, $guests, $card_number, $card_expiry, $card_cvv);

  if ($stmt->execute()) {
    echo json_encode([
      "message" => "Reserva feita com sucesso!",
      "reservation_id" => $stmt->insert_id,
    ]);
  } else {
    echo json_encode(["error" => "Erro ao fazer reserva: " . $stmt->error]);
  }

  $stmt->close();
} else {
  echo json_encode(["error" => "Método não permitido"]);
}

$conn->close();
