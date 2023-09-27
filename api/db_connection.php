<?php
$host = 'containers-us-west-154.railway.app';  // Host do banco de dados
$db_user = 'root';  // Usuário do banco de dados
$db_pass = 'L9jSiHggck6d8t9KkqgX';  // Senha do banco de dados
$db_name = 'railway';  // Nome do banco de dados

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Verificar se a conexão está funcionando
if ($conn->ping()) {
    echo "Conexão bem-sucedida!";
} else {
    echo "A conexão não está funcionando.";
}

?>
