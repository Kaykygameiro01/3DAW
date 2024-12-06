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
  $type = $_POST['type'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $status = $_POST['status']; // Verifique se esse valor está sendo recebido corretamente
  $image_url = $_POST['image_url'];

  $sql = "INSERT INTO rooms (type, description, price, status, image_url) 
            VALUES (?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssss", $type, $description, $price, $status, $image_url);

  if ($stmt->execute()) {
    echo json_encode(["message" => "Quarto adicionado com sucesso!"]);
  } else {
    echo json_encode(["error" => "Erro ao adicionar quarto: " . $stmt->error]);
  }

  $stmt->close();
}

$conn->close();
