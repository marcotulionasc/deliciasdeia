<?php
$host = 'localhost'; 
$db_user = 'root'; 
$db_pass = ''; 
$db_name = 'deia'; 

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
