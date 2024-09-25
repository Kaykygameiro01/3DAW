<?php
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $pergunta = $_POST["pergunta"];
  $respostas = $_POST["respostas"];

  if (empty($pergunta) || empty($respostas) || in_array("", $respostas)) {
    $msg = "Preencha todos os campos!";
  } else {
    echo "Pergunta: " . $pergunta . "<br>";
    echo "Respostas: " . implode(", ", $respostas) . "<br>";

    $arqDisc = fopen("perguntas.txt", "a") or die("Erro ao criar arquivo");

    $id = uniqid();
    $linha = $id . ";" . $pergunta . ";" . implode("|", $respostas) . "\n";

    fwrite($arqDisc, $linha);
    fclose($arqDisc);

    $msg = "Pergunta cadastrada com sucesso!";
  }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Criar nova Pergunta</title>
</head>

<body>
  <h1>Criar nova Pergunta</h1>

  <form action="" method="POST">
    Pergunta: <input type="text" name="pergunta" required><br><br>
    Resposta 1: <input type="text" name="respostas[]" required><br><br>
    Resposta 2: <input type="text" name="respostas[]" required><br><br>
    Resposta 3: <input type="text" name="respostas[]" required><br><br>
    Resposta 4: <input type="text" name="respostas[]" required><br><br>

    <input type="submit" value="Criar nova pergunta">
  </form>

  <p><?php echo $msg; ?></p>
</body>

</html>