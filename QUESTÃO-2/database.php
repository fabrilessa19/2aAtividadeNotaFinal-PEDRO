<?php
$arquivoBanco = __DIR__ . '/tarefas.sqlite';

try {
    $conexao = new PDO("sqlite:" . $arquivoBanco);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conexao->exec("
        CREATE TABLE IF NOT EXISTS tarefas (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            descricao TEXT NOT NULL,
            data_vencimento TEXT,
            concluida INTEGER DEFAULT 0
        );
    ");

} catch (PDOException $erro) {
    die("Erro no banco: " . $erro->getMessage());
}

