<?php
$arquivoBanco = __DIR__ . '/database.sqlite';

try {
    $conexao = new PDO("sqlite:" . $arquivoBanco);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conexao->exec("
        CREATE TABLE IF NOT EXISTS livros (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            titulo TEXT NOT NULL,
            autor TEXT NOT NULL,
            ano INTEGER
        );
    ");
} catch (PDOException $erro) {
    die("Erro ao conectar ao banco: " . $erro->getMessage());
}

