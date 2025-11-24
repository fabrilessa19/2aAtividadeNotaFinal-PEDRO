<?php
require_once "database.php";

$idTarefa = $_POST["id"] ?? "";

if (ctype_digit($idTarefa)) {
    $sql = $conexao->prepare("UPDATE tarefas SET concluida = 1 WHERE id = :id");
    $sql->execute([":id" => $idTarefa]);
}

header("Location: index.php");
exit;

