<?php
require_once "database.php";

$descTarefa = trim($_POST["descricao"] ?? "");
$dataTarefa = trim($_POST["data_vencimento"] ?? "");

if ($descTarefa === "") {
    header("Location: index.php?erro=1");
    exit;
}

$sql = $conexao->prepare("INSERT INTO tarefas (descricao, data_vencimento) VALUES (:d, :v)");

$sql->execute([
    ":d" => $descTarefa,
    ":v" => $dataTarefa ?: null
]);

header("Location: index.php?ok=1");
exit;
