<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Lista de Alunos</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <h1>Lista de Alunos</h1>
  <a href="index.php">Voltar</a>
  <table>
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>CPF</th>
      <th>Matrícula</th>
      <th>Data de Nascimento</th>
      <th>Ações</th>
    </tr>
    <?php
    include 'db.php';
    $sql = "SELECT * FROM alunos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nome']}</td>
                    <td>{$row['cpf']}</td>
                    <td>{$row['matricula']}</td>
                    <td>{$row['data_nascimento']}</td>
                    <td>
                        <a href='update.php?id={$row['id']}'>Editar</a>
                        <a href='delete.php?id={$row['id']}'>Excluir</a>
                    </td>
                </tr>";
      }
    } else {
      echo "<tr><td colspan='6'>Nenhum aluno encontrado.</td></tr>";
    }

    $conn->close();
    ?>
  </table>
</body>

</html>