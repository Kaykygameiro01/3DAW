<?php
    $sigla = "";
    $msg = "";
    $nome = "";
    $carga = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET')  {
    $sigla = $_GET["sigla"];
    $msg = "";
    echo " sigla: " . $sigla;
    $arqDisc = fopen("disciplinas.txt","r") or die("erro ao abrir arquivo");

    while(!feof($arqDisc)) {
        $linha = fgets($arqDisc);
        $colunaDados = explode(";", $linha);
        if $colunaDados[1] = $sigla {
            $nome = $colunaDados[0];
            $carga = $colunaDados[2];
            break;
        }
     }
    fclose($arqDisc);
    $msg = "Deu tudo certo!!!";
}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h1>Alterar Disciplina</h1>
<br>
<ul>
    <li><a href="ex03_IncluirDisciplina.php">Incluir Disciplina</a></li>
    <li><a href="ex04_listarTodasDisciplinas.php">Listar Disciplina</a></li>
    <li><a href="ex05_pedeQuemAlterar.php">Incluir Disciplina</a></li>
</ul>
<form action="ex05_AlterarDisciplina.php" method="POST">
    Nome: <input type="text" name="nome" 
                value='<?php echo $nome ?>'>
    <br><br>
    Sigla: <input type="text" name="sigla"  
                value='<?php echo $sigla ?>'>
    <br><br>
    Carga Horaria: <input type="text" name="carga"  
            value='<?php echo $carga ?>'>
    <br><br>
    <input type="submit" value="Alterar Disciplina">
</form>
<p><?php echo $msg ?></p>
<br>
</body>
</html>