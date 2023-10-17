<?php
// Conexão com o servidor na nuvem da Railway

session_start();
$DB_HOST = $_ENV["DB_HOST"];
$DB_USER = $_ENV["DB_USER"];
$DB_PASSWORD = $_ENV["DB_PASSWORD"];
$DB_NAME = $_ENV["DB_NAME"];
$DB_PORT = $_ENV["DB_PORT"];

// Tenta conectar ao servidor
$db = new mysqli("host=$DB_HOST dbname=$DB_NAME user=$DB_USER password=$DB_PASSWORD port=$DB_PORT");

if (!$db) {
    // Se a conexão com o servidor falhar, tente a conexão local
    $hostname = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $database = "deia-homolog"; 
    $db = new mysqli($hostname, $username, $password, $database);
    
    if ($db->connect_error) {
        die("Falha na conexão com o servidor e com o banco de dados local: " . $db->connect_error);
    }
}
// Agora você tem uma conexão ativa, seja com o servidor ou com o banco de dados local.
?>
