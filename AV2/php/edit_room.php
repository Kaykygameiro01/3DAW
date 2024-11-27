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
  error_log(print_r($_POST, true));
  $id = $_POST['id'];
  $type = $_POST['type'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $status = $_POST['status']; // Verifique se o status está sendo atualizado corretamente
  $image_url = $_POST['image_url'];

  $sql = "UPDATE rooms SET type = ?, description = ?, price = ?, status = ?, image_url = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssdsi", $type, $description, $price, $status, $image_url, $id);

  if ($stmt->execute()) {
    echo json_encode(["message" => "Quarto atualizado com sucesso!"]);
  } else {
    echo json_encode(["error" => "Erro ao atualizar quarto: " . $stmt->error]);
  }

  $stmt->close();
}

$conn->close();
