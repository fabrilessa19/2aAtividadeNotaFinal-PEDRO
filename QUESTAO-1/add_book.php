<?php
require_once "database.php";

$tituloLivro = trim($_POST["titulo"] ?? "");
$autorLivro  = trim($_POST["autor"] ?? "");
$anoLivro    = trim($_POST["ano"] ?? "");

if ($tituloLivro === "" || $autorLivro === "") {
    header("Location: index.php?erro=1");
    exit;
}

$sql = $conexao->prepare("INSERT INTO livros (titulo, autor, ano) VALUES (:t, :a, :n)");

$sql->execute([
    ":t" => $tituloLivro,
    ":a" => $autorLivro,
    ":n" => $anoLivro ?: null
]);

header("Location: index.php?ok=1");
exit;
