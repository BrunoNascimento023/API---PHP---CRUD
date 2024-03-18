<?php
$host = 'localhost';
$username = 'root'; 
$password = ''; // Senha do banco de dados
$dbname = 'teste-api';



$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
} else {
    echo "Conexão bem-sucedida!";
}
?>
