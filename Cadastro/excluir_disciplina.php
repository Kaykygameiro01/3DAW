<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $siglaParaExcluir = trim($_POST['sigla']);

  $linhas = file("disciplinas.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

  $arq = fopen("disciplinas.txt", "w") or die("Erro ao abrir o arquivo para escrita");

  $disciplinaEncontrada = false;

  foreach ($linhas as $linha) {
    $colunaDados = explode(";", trim($linha));

    if (count($colunaDados) == 3 && trim($colunaDados[1]) != $siglaParaExcluir) {
      fwrite($arq, $linha . PHP_EOL);
    } else if (count($colunaDados) == 3 && trim($colunaDados[1]) == $siglaParaExcluir) {
      $disciplinaEncontrada = true;
    }
  }

  fclose($arq);

  if ($disciplinaEncontrada) {
    echo "Disciplina com sigla '" . htmlspecialchars($siglaParaExcluir) . "' foi excluída com sucesso.";
  } else {
    echo "Disciplina não encontrada ou erro ao excluir.";
  }

  header("Location: index.php");
  exit;
}
