<?php

try {
    require_once __DIR__ . '/conexao.php';
    echo 'CONEXÃO COM POSTGRESQL OK!';
} catch (Throwable $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'Não foi possível conectar ao PostgreSQL. Verifique o terminal do PHP.';
}