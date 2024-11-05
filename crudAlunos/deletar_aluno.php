<?php
require 'db.php';

$id = $_POST['id'] ?? 0;

$query = "DELETE FROM alunos WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);

echo "Aluno removido com sucesso!";
