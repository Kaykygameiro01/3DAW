<?php
$msg = "";
$id = $_GET['id'] ?? '';

if (!empty($id)) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $novaPergunta = $_POST['pergunta'] ?? '';
        $novasRespostas = $_POST['respostas'] ?? '';

        $arquivo = "perguntas.txt";
        $linhas = file($arquivo, FILE_IGNORE_NEW_LINES);
        $alterado = false;

        foreach ($linhas as $indice => $linha) {
            $colunaDados = explode(';', $linha);
            if ($colunaDados[0] == $id) {
                $colunaDados[1] = $novaPergunta;
                $colunaDados[2] = $novasRespostas;
                $linhas[$indice] = implode(';', $colunaDados);
                $alterado = true;
                break;
            }
        }

        if ($alterado) {
            file_put_contents($arquivo, implode("\n", $linhas) . "\n");
            $msg = "Pergunta alterada com sucesso!";
        } else {
            $msg = "Pergunta não encontrada.";
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

    <form action="alterar_pergunta.php?id=<?php echo $id; ?>" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        Pergunta: <input type="text" name="pergunta" value="<?php echo isset($pergunta) ? $pergunta : ''; ?>"><br><br>
        Respostas: <input type="text" name="respostas" value="<?php echo isset($respostas) ? $respostas : ''; ?>"><br><br>
        <input type="submit" value="Salvar Alterações">
    </form>

    <p><?php echo $msg; ?></p>

    <br>
    <a href="listar_perguntas.php">Voltar para Listagem de Perguntas</a>
</body>
</html>
