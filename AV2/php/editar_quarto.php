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
  error_log(print_r($_POST, true)); // Verifica todos os valores enviados pelo formulário

  $id = $_POST['id'];
  $type = $_POST['type'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $status = $_POST['status']; // Verifique se o valor é recebido corretamente
  $image_url = $_POST['image_url'];

  error_log("Status recebido: $status"); // Log específico para o status

  $sql = "UPDATE rooms SET type = ?, description = ?, price = ?, status = ?, image_url = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);

  // Certifique-se de que a ordem dos parâmetros está correta
  $stmt->bind_param("ssdssi", $type, $description, $price, $status, $image_url, $id);

  if ($stmt->execute()) {
    echo json_encode(["message" => "Quarto atualizado com sucesso!"]);
  } else {
    error_log("Erro ao executar query: " . $stmt->error);
    echo json_encode(["error" => "Erro ao atualizar quarto: " . $stmt->error]);
  }


  $stmt->close();
}


$conn->close();
