<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    echo "Nome: " . $nome . " | Email: " . $email . " | Senha: " . $senha . "<br>";

    $arqDisc = fopen("usuarios.txt", "a") or die("Erro ao criar arquivo");
  
    $linha = $nome . ";" . $email . ";" . $senha . "\n";
  
    fwrite($arqDisc, $linha);
  
    fclose($arqDisc);
  
    $msg = "Usuário cadastrado com sucesso!";

    }

?>

<!DOCTYPE html> 

<html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastro de Usuários</title>
</head>

<body>
    <h1>Cadastro de Usuários</h1>
   <form action="Cadastro_Usuario.php" method="POST">
   Nome: <input type="text" name="nome">
   Email: <input type="email" name="email">
   Senha: <input type="password" name="senha">
   <input type="submit" name="Enviar">
   <form>

   <p><?php echo $msg; ?></p>

</body>
</html>