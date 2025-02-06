<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!empty($_POST['nome']) && !empty($_POST['cpf']) && !empty($_POST['matricula']) && !empty($_POST['data_nascimento'])) {

    if (isset($_POST['create'])) {
      $sql = $conn->prepare("INSERT INTO alunos (nome, cpf, matricula, data_nascimento) VALUES (?, ?, ?, ?)");
      $sql->bind_param("ssss", $_POST['nome'], $_POST['cpf'], $_POST['matricula'], $_POST['data_nascimento']);

      if ($sql->execute()) {
        echo "Aluno cadastrado.";
      } else {
        echo "Erro ao cadastrar: " . $sql->error;
      }
    }

    if (isset($_POST['update']) && isset($_POST['id'])) {
      $sql = $conn->prepare("UPDATE alunos SET nome=?, cpf=?, matricula=?, data_nascimento=? WHERE id=?");
      $sql->bind_param("ssssi", $_POST['nome'], $_POST['cpf'], $_POST['matricula'], $_POST['data_nascimento'], $_POST['id']);

      if ($sql->execute()) {
        echo "Dados atualizados.";
      } else {
        echo "Erro ao atualizar: " . $sql->error;
      }
    }
  } else {
    echo "Todos os campos são obrigatórios.";
  }
}

$conn->close();
?>
<a href="read.php">Voltar</a>