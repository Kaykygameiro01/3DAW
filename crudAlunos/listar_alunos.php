<?php
require 'db.php';

$query = "SELECT * FROM alunos";
$result = $pdo->query($query);

echo json_encode($result->fetchAll(PDO::FETCH_ASSOC));
