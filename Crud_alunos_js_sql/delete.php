<?php
include 'db.php';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  $sql = $conn->prepare("DELETE FROM alunos WHERE id=?");
  $sql->bind_param("i", $id);

  if ($sql->execute()) {
    echo "Aluno removido.";
  } else {
    echo "Erro ao excluir: " . $sql->error;
  }
}

$conn->close();
?>
<a href="read.php">Voltar</a>