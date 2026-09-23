<?php

$config = parse_ini_file(__DIR__ . '/.env', false, INI_SCANNER_RAW);

if ($config === false) {
    throw new RuntimeException('Não foi possível ler o arquivo .env');
}

$dsn = 'pgsql:host=' . $config['DB_HOST']
     . ';port=' . $config['DB_PORT']
     . ';dbname=' . $config['DB_NAME'];

$pdo = new PDO(
    $dsn,
    $config['DB_USER'],
    $config['DB_PASS'],
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);