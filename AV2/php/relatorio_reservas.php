<?php
header('Content-Type: application/json');

$host = 'localhost';
$db = 'albergue';
$user = 'root';
$pass = '';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $query = "SELECT r.id, c.nome AS client_name, r.data_entrada AS start_date, r.data_saida AS end_date, 
              q.tipo AS room_type, r.status 
              FROM reservas r
              JOIN clientes c ON r.cliente_id = c.id
              JOIN quartos q ON r.quarto_id = q.id";

  // Filtro por datas
  if (isset($_GET['start']) && isset($_GET['end'])) {
    $query .= " WHERE r.data_entrada >= :start AND r.data_saida <= :end";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':start', $_GET['start']);
    $stmt->bindParam(':end', $_GET['end']);
  } else {
    $stmt = $pdo->prepare($query);
  }

  $stmt->execute();
  $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode($reservations);
} catch (PDOException $e) {
  echo json_encode(['error' => $e->getMessage()]);
}
