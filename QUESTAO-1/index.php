<?php
require_once "database.php";

$mensagemErro = isset($_GET["erro"]);
$mensagemOk   = isset($_GET["ok"]);

$listaLivros = $conexao->query("SELECT * FROM livros ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Sistema de Livros</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    header {
        background: #333;
        color: #fff;
        padding: 18px;
        text-align: center;
    }

    .caixa {
        width: 90%;
        max-width: 700px;
        margin: 25px auto;
        background: #fff;
        padding: 20px;
        border-radius: 6px;
        box-shadow: 0 0 6px rgba(0,0,0,.1);
    }

    form input, form button {
        width: 100%;
        padding: 10px;
        margin: 7px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    form button {
        background: #333;
        color: #fff;
        cursor: pointer;
    }

    form button:hover {
        background: #555;
    }

    .msg-erro {
        background: #ffb3b3;
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 15px;
    }

    .msg-ok {
        background: #c2ffba;
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 15px;
    }

    .item-livro {
        padding: 12px;
        margin-bottom: 10px;
        border-bottom: 1px solid #ddd;
    }

    .item-livro form {
        display: inline;
    }

    .item-livro button {
        background: #c62828;
        color: white;
        border: none;
        padding: 6px 10px;
        border-radius: 4px;
        cursor: pointer;
    }

    .item-livro button:hover {
        background: #a31616;
    }
</style>

</head>
<body>

<header>
    <h1>Sistema de Livros</h1>
</header>

<div class="caixa">

    <?php if ($mensagemErro): ?>
        <div class="msg-erro">Preencha título e autor.</div>
    <?php endif; ?>

    <?php if ($mensagemOk): ?>
        <div class="msg-ok">Livro cadastrado com sucesso!</div>
    <?php endif; ?>

    <h2>Adicionar Livro</h2>

    <form action="add_book.php" method="POST">
        <input type="text" name="titulo" placeholder="Título do livro" required>
        <input type="text" name="autor" placeholder="Autor" required>
        <input type="number" name="ano" placeholder="Ano (opcional)">
        <button type="submit">Cadastrar</button>
    </form>

    <h2>Livros Cadastrados</h2>

    <?php if (empty($listaLivros)): ?>
        <p>Nenhum livro cadastrado.</p>
    <?php else: ?>
        <?php foreach ($listaLivros as $livro): ?>
            <div class="item-livro">
                <strong><?= htmlspecialchars($livro["titulo"]) ?></strong><br>
                Autor: <?= htmlspecialchars($livro["autor"]) ?><br>
                Ano: <?= $livro["ano"] ?: "—" ?><br><br>

                <form action="delete_book.php" method="POST">
                    <input type="hidden" name="id" value="<?= $livro["id"] ?>">
                    <button>Excluir</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</div>

</body>
</html>
