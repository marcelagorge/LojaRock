<?php

// Configuração do banco de dados
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'lojavirtual');

function obterConexaoDB() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME /*,3307*/);

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    return $conn;
}
