<?php
// Conexão com o banco de dados
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'hostel_app';

$conn = new mysqli($host, $user, $password, $database);

// Verificar conexão
if ($conn->connect_error) {
    die('Erro de conexão: ' . $conn->connect_error);
}

// Verificar se os dados foram enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $conn->real_escape_string($_POST['nome']);
    $email = $conn->real_escape_string($_POST['email']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Hash seguro da senha

    // Tipo de usuário sempre definido como 'cliente'
    $tipo = 'cliente';

    // Inserir no banco de dados
    $sql = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES ('$nome', '$email', '$senha', '$tipo')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Cadastro realizado com sucesso!');
                window.location.href = '../login.html';
              </script>";
    } else {
        echo "<script>
                alert('Erro ao cadastrar: " . $conn->error . "');
                window.history.back();
              </script>";
    }
}

$conn->close();
