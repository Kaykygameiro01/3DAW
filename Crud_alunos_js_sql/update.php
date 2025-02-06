<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Editar Aluno</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <h1>Editar Aluno</h1>
  <?php
  include 'db.php';

  if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM alunos WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
    } else {
      echo "Aluno não encontrado.";
      exit;
    }
  } else {
    echo "ID inválido.";
    exit;
  }
  ?>
  <form action="aluno.php" method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <label>Nome:</label>
    <input type="text" name="nome" value="<?php echo $row['nome']; ?>" required>

    <label>CPF:</label>
    <input type="text" name="cpf" value="<?php echo $row['cpf']; ?>" required>

    <label>Matrícula:</label>
    <input type="text" name="matricula" value="<?php echo $row['matricula']; ?>" required>

    <label>Data de Nascimento:</label>
    <input type="date" name="data_nascimento" value="<?php echo $row['data_nascimento']; ?>" required>

    <button type="submit" name="update">Salvar</button>
  </form>
</body>

</html>