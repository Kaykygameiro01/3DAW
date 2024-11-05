<?php
require 'db.php';

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$idade = $_POST['idade'] ?? 0;

$query = "INSERT INTO alunos (nome, email, idade) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($query);
$stmt->execute([$nome, $email, $idade]);

echo "Aluno inserido com sucesso!";
