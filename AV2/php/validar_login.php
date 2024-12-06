<?php
session_start();

$host = 'localhost';
$db = 'hostel_app';
$user = 'root';
$pass = '';

header('Content-Type: application/json');

try {
  $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Verifica se os dados foram enviados
  if (empty($_POST['email']) || empty($_POST['senha'])) {
    echo json_encode(['success' => false, 'message' => 'Email ou senha não enviados.']);
    exit;
  }

  $email = $_POST['email'];
  $senha = $_POST['senha'];

  // Consulta ao banco para obter o hash da senha
  $query = "SELECT id, nome, tipo, senha FROM usuarios WHERE email = :email";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':email', $email);
  $stmt->execute();

  $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($usuario && password_verify($senha, $usuario['senha'])) {
    // Login válido
    $_SESSION['user_id'] = $usuario['id'];
    $_SESSION['user_name'] = $usuario['nome'];
    $_SESSION['user_type'] = $usuario['tipo'];

    echo json_encode([
      'success' => true,
      'redirect' => $usuario['tipo'] === 'admin' ? 'admin.html' : 'reserva_cliente.html',
    ]);
  } else {
    // Login inválido
    echo json_encode(['success' => false, 'message' => 'Credenciais inválidas.']);
  }
} catch (PDOException $e) {
  echo json_encode(['success' => false, 'message' => 'Erro no banco: ' . $e->getMessage()]);
}
