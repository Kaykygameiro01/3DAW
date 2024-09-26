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
      <th>Ações</th> <!-- Nova coluna para ações -->
    </tr>

    <?php
    $arquivo = "perguntas.txt";
    if (file_exists($arquivo)) {
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
        echo "<td><a href='alterar_pergunta.php?id=$id'>Alterar</a> | ";
        echo "<a href='excluir_pergunta.php?id=$id' onclick='return confirm(\"Tem certeza que deseja excluir esta pergunta?\");'>Excluir</a></td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='4'>Nenhuma pergunta encontrada.</td></tr>";
    }
    ?>

  </table>
</body>

</html>