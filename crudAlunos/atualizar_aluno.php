<?php
require 'db.php';

$id = $_POST['id'] ?? 0;
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$idade = $_POST['idade'] ?? 0;

$query = "UPDATE alunos SET nome = ?, email = ?, idade = ? WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$nome, $email, $idade, $id]);

echo "Aluno atualizado com sucesso!";
