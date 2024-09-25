<!DOCTYPE html>
<html>

<head>
  <title>Listar Perguntas</title>
  <style>
    table,
    th,
    td {
      border: 1px solid black;
      padding: 8px;
    }

    table {
      width: 100%;
    }
  </style>
</head>

<body>
  <h1>Listar Perguntas</h1>
  <table>
    <tr>
      <th>ID</th>
      <th>Pergunta</th>
      <th>Respostas</th>
    </tr>

    <?php
    $arquivo = "perguntas.txt";
    $linhas = file($arquivo, FILE_IGNORE_NEW_LINES);

    foreach ($linhas as $linha) {
      $dados = explode(';', $linha);
      $id = $dados[0];
      $pergunta = $dados[1];
      $respostas = $dados[2];

      echo "<tr>";
      echo "<td>$id</td>";
      echo "<td>$pergunta</td>";
      echo "<td>$respostas</td>";
      echo "</tr>";
    }
    ?>

  </table>
</body>

</html>