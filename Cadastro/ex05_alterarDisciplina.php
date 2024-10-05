<?php
$sigla = "";
$nome = "";
$carga = "";
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['sigla'])) {
    $sigla = $_GET['sigla'];


    $arqDisc = fopen("disciplinas.txt", "r") or die("Erro ao abrir arquivo");

    while (!feof($arqDisc)) {
        $linha = fgets($arqDisc);
        $colunaDados = explode(";", trim($linha));

        if (count($colunaDados) == 3 && $colunaDados[1] == $sigla) {
            $nome = $colunaDados[0];
            $carga = $colunaDados[2];
            break;
        }
    }

    fclose($arqDisc);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $sigla = $_POST['sigla'];
    $carga = $_POST['carga'];


    $linhas = file("disciplinas.txt");


    $arq = fopen("disciplinas.txt", "w") or die("Erro ao abrir arquivo");

    foreach ($linhas as $linha) {
        $colunaDados = explode(";", trim($linha));

        if (count($colunaDados) == 3 && $colunaDados[1] == $sigla) {
            fwrite($arq, "$nome;$sigla;$carga\n");
        } else {
            fwrite($arq, $linha);
        }
    }

    fclose($arq);

    $msg = "Disciplina alterada com sucesso!";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Alterar Disciplina</title>
</head>

<body>
    <h1>Alterar Disciplina</h1>
    <br>
    <ul>
        <li><a href="ex03_IncluirDisciplina.php">Incluir Disciplina</a></li>
        <li><a href="index.php">Listar Disciplinas</a></li>
    </ul>
    <form action="ex05_AlterarDisciplina.php" method="POST">
        Nome: <input type="text" name="nome" value="<?php echo $nome; ?>">
        <br><br>
        Sigla: <input type="text" name="sigla" value="<?php echo $sigla; ?>" readonly>
        <br><br>
        Carga Horária: <input type="text" name="carga" value="<?php echo $carga; ?>">
        <br><br>
        <input type="submit" value="Alterar Disciplina">
    </form>
    <p><?php echo $msg; ?></p>
</body>

</html>