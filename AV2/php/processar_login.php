<?php
session_start();

// Conectar ao banco de dados
$conn = new mysqli("localhost", "root", "", "hostel_app");

// Verificar conexão
if ($conn->connect_error) {
  die("Erro na conexão: " . $conn->connect_error);
}

// Receber os dados do formulário
$email = $_POST['email'];
$senha = $_POST['senha'];

// Consultar o banco de dados
$sql = "SELECT id, nome, tipo_usuario FROM usuarios WHERE email = ? AND senha = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $senha);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $user = $result->fetch_assoc();
  $_SESSION['usuario_id'] = $user['id'];
  $_SESSION['nome'] = $user['nome'];
  $_SESSION['tipo_usuario'] = $user['tipo_usuario'];

  // Redirecionar com base no tipo de usuário
  if ($user['tipo_usuario'] === 'admin') {
    header("Location: ../administracao.html");
  } else {
    header("Location: ../index.html");
  }
  exit;
} else {
  echo "E-mail ou senha inválidos.";
}

$stmt->close();
$conn->close();
