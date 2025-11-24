<?php
require_once "database.php";

$idTarefa = $_POST["id"] ?? "";

if (ctype_digit($idTarefa)) {
    $sql = $conexao->prepare("DELETE FROM tarefas WHERE id = :id");
    $sql->execute([":id" => $idTarefa]);
}

header("Location: index.php");
exit;
