<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $arquivo = "perguntas.txt";

  if (file_exists($arquivo)) {
    $linhas = file($arquivo, FILE_IGNORE_NEW_LINES);
    $novaLista = [];

    // Percorre o arquivo e mantém todas as perguntas, exceto a que tem o ID a ser deletado
    foreach ($linhas as $linha) {
      $colunaDados = explode(';', $linha);
      if ($colunaDados[0] != $id) {
        $novaLista[] = $linha;
      }
    }

    // Atualiza o arquivo de perguntas sem a pergunta excluída
    file_put_contents($arquivo, implode("\n", $novaLista) . "\n");
    header("Location: listar_perguntas.php?msg=Pergunta excluída com sucesso!");
    exit();
  } else {
    echo "Arquivo de perguntas não encontrado.";
  }
} else {
  echo "ID de pergunta inválido.";
}
