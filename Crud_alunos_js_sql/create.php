<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Novo Aluno</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <h1>Cadastro de Aluno</h1>
  <form action="aluno.php" method="post">
    <label>Nome:</label>
    <input type="text" name="nome" required>

    <label>CPF:</label>
    <input type="text" name="cpf" required>

    <label>Matrícula:</label>
    <input type="text" name="matricula" required>

    <label>Data de Nascimento:</label>
    <input type="date" name="data_nascimento" required>

    <button type="submit" name="create">Salvar</button>
  </form>
</body>

</html>