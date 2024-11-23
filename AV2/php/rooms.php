<?php
// Habilitar a exibição de erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configuração de conexão com o banco de dados
$host = "localhost";
$user = "root";
$password = "";
$database = "hostel_app";

// Conectar ao banco de dados
$conn = new mysqli($host, $user, $password, $database);

// Verificar se a conexão foi bem-sucedida
if ($conn->connect_error) {
  die(json_encode(["error" => "Falha na conexão: " . $conn->connect_error]));
}

// Consultar todos os quartos na tabela 'rooms'
$sql = "SELECT * FROM rooms";
$result = $conn->query($sql);

// Verificar se houve algum erro na consulta SQL
if ($result === false) {
  die(json_encode(["error" => "Erro ao executar a consulta: " . $conn->error]));
}

// Armazenar os dados dos quartos em um array
$rooms = [];
while ($row = $result->fetch_assoc()) {
  $rooms[] = $row;
}

// Retornar os dados dos quartos em formato JSON
echo json_encode($rooms);

// Fechar a conexão com o banco de dados
$conn->close();
