<?php
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $pergunta = $_POST["pergunta"];
  $respostas = $_POST["resposta"];

  echo "Pergunta: " . $pergunta . " | Resposta: " . $respostas . "<br>";

  $arqDisc = fopen("perguntas.txt", "a") or die("Erro ao criar arquivo");

  $linha = $pergunta . ";" . $respostas . "\n";

  fwrite($arqDisc, $linha);
  
  $id = uniqid();

  fclose($arqDisc);
  $msg = "Pergunta cadastrada com sucesso!";
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
    Pergunta: <input type="text" name="pergunta"><br><br>
    Respostas: <input type="text" name="respostas"><br><br>
    Respostas: <input type="text" name="respostas"><br><br>
    Respostas: <input type="text" name="respostas"><br><br>
    Respostas: <input type="text" name="respostas"><br><br>


    <input type="submit" value="Criar nova pergunta">
  </form>

  <p><?php echo $msg; ?></p>
</body>

</html>
