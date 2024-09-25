<?php
$msg = "";
$id = $_GET['id'] ?? '';

$arquivo = "perguntas.txt";

if (file_exists($arquivo)) {
    $linhas = file($arquivo, FILE_IGNORE_NEW_LINES);

    $perguntaEncontrada = false;

    foreach ($linhas as $linha) {
        $colunaDados = explode(';', $linha);
        if ($colunaDados[0] == $id) {
            $pergunta = $colunaDados[1];
            $respostas = explode('|', $colunaDados[2]);
            $perguntaEncontrada = true;
            break;
        }
    }

    if ($perguntaEncontrada && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $novaPergunta = $_POST['pergunta'] ?? '';
        $novasRespostasArray = $_POST['respostas'] ?? [];

        if (!empty($novaPergunta) && !empty($novasRespostasArray)) {
            $novasRespostas = implode('|', $novasRespostasArray);

            foreach ($linhas as $indice => $linha) {
                $colunaDados = explode(';', $linha);
                if ($colunaDados[0] == $id) {
                    $colunaDados[1] = $novaPergunta;
                    $colunaDados[2] = $novasRespostas;
                    $linhas[$indice] = implode(';', $colunaDados);
                    break;
                }
            }

            file_put_contents($arquivo, implode("\n", $linhas) . "\n");
            $msg = "Pergunta alterada com sucesso!";
        } else {
            $msg = "Preencha todos os campos corretamente!";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Alterar Pergunta</title>
</head>

<body>
    <h1>Alterar Pergunta</h1>
    <?php if (isset($pergunta) && isset($respostas)) { ?>
        <form action="alterar_pergunta.php?id=<?php echo $id; ?>" method="POST">
            Pergunta: <input type="text" name="pergunta" value="<?php echo htmlspecialchars($pergunta); ?>"><br><br>

            <?php foreach ($respostas as $index => $resposta) { ?>
                Resposta <?php echo $index + 1; ?>: <input type="text" name="respostas[]" value="<?php echo htmlspecialchars($resposta); ?>"><br><br>
            <?php } ?>

            <input type="submit" value="Salvar Alterações">
        </form>
    <?php } ?>

    <p><?php echo $msg; ?></p>

    <br>
    <a href="listar_perguntas.php">Voltar para Listagem de Perguntas</a>
</body>

</html>