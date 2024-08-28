<?php
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nome = $_POST["nome"];
  $sigla = $_POST["sigla"];
  $carga = $_POST["carga"];

  echo "Nome: " . $nome . " | Sigla: " . $sigla . " | Carga: " . $carga . "<br>";

  $arqDisc = fopen("disciplinas.txt", "a") or die("Erro ao criar arquivo");

  $linha = $nome . ";" . $sigla . ";" . $carga . "\n";

  fwrite($arqDisc, $linha);

  fclose($arqDisc);

  $msg = "Disciplina cadastrada com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Criar nova disciplina</title>
</head>

<body>
  <h1>Criar nova disciplina</h1>

  <form action="" method="POST">
    Nome: <input type="text" name="nome"><br><br>
    Sigla: <input type="text" name="sigla"><br><br>
    Carga Horária: <input type="text" name="carga"><br><br>
    <input type="submit" value="Criar nova disciplina">
  </form>

  <p><?php echo $msg; ?></p>
</body>

</html>