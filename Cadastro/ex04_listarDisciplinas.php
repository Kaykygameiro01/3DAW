<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Listar Disciplinas</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
      margin: 0;
      padding: 20px;
    }

    h1 {
      text-align: center;
      color: #333;
    }

    table {
      width: 80%;
      margin: 20px auto;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    th,
    td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #4CAF50;
      color: white;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    td form,
    td a {
      display: inline-block;
      margin-right: 10px;
    }

    a {
      color: #4CAF50;
      text-decoration: none;
      font-weight: bold;
    }

    a:hover {
      text-decoration: underline;
    }

    input[type="submit"] {
      background-color: #f44336;
      color: white;
      border: none;
      padding: 8px 16px;
      text-decoration: none;
      cursor: pointer;
      font-weight: bold;
    }

    input[type="submit"]:hover {
      background-color: #d32f2f;
    }

    p {
      text-align: center;
      font-size: 18px;
      color: #333;
    }
  </style>
</head>

<body>
  <h1>Listar Disciplinas</h1>
  <table>
    <tr>
      <th>Nome</th>
      <th>Sigla</th>
      <th>Carga</th>
      <th>Ações</th>
    </tr>
    <?php
    $arqDisc = fopen("disciplinas.txt", "r") or die("Erro ao abrir arquivo");

    while (!feof($arqDisc)) {
      $linha = fgets($arqDisc);
      $colunaDados = explode(";", trim($linha));

      if (count($colunaDados) == 3) {
        echo "<tr><td>" . $colunaDados[0] . "</td>" .
          "<td>" . $colunaDados[1] . "</td>" .
          "<td>" . $colunaDados[2] . "</td>" .
          "<td><form method='post' action='excluir_disciplina.php'>" .
          "<input type='hidden' name='sigla' value='" . $colunaDados[1] . "'>" .
          "<input type='submit' value='Excluir'>" .
          "</form>" .
          " <a href='ex05_AlterarDisciplina.php?sigla=" . $colunaDados[1] . "'>Alterar</a>" .
          "</td></tr>";
      }
    }

    fclose($arqDisc);
    ?>
  </table>
</body>

</html>