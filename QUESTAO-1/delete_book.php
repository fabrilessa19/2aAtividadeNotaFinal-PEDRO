<?php
require_once "database.php";

$idLivro = $_POST["id"] ?? "";

if (ctype_digit($idLivro)) {
    $sql = $conexao->prepare("DELETE FROM livros WHERE id = :id");
    $sql->execute([":id" => $idLivro]);
}

header("Location: index.php");
exit;
