<?php
$host = "192.168.208.16";
$port = "5432";
$dbname = "db1";
$user = "VBSUP";
$password = "VBRemotoManutencao";

try {
    $dbcon = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
} catch (PDOException $err) {
    echo "Erro: Conexão com banco de dados falhou (Erro: " . $err->getMessage();
}
