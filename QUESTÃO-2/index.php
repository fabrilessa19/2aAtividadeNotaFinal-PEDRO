<?php
require_once "database.php";

$mensagemErro = isset($_GET["erro"]);
$mensagemOk   = isset($_GET["ok"]);

$tarefasPendentes = $conexao
    ->query("SELECT * FROM tarefas WHERE concluida = 0 ORDER BY data_vencimento")
    ->fetchAll(PDO::FETCH_ASSOC);

$tarefasFeitas = $conexao
    ->query("SELECT * FROM tarefas WHERE concluida = 1 ORDER BY id DESC")
    ->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Lista de Tarefas </title>

<style>
    body {
        font-family: Arial;
        background: #f2f2f2;
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
        background: #fff;
        margin: 25px auto;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0,0,0,.1);
    }

    form input, form button {
        width: 100%;
        padding: 10px;
        margin: 7px 0;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    button {
        background: #333;
        color: #fff;
        cursor: pointer;
    }

    button:hover {
        background: #444;
    }

    .msg-ok {
        background: #c2ffba;
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 15px;
    }

    .msg-erro {
        background: #ffb3b3;
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 15px;
    }

    .tarefa {
        padding: 12px;
        margin-bottom: 10px;
        border-bottom: 1px solid #ddd;
    }

    .tarefa form {
        display: inline;
    }

    .btn-excluir {
        background: #c62828;
    }

    .btn-excluir:hover {
        background: #a31616;
    }
</style>

</head>
<body>

<header>
    <h1>Lista de Tarefas</h1>
</header>

<div class="caixa">

    <?php if ($mensagemErro): ?>
        <div class="msg-erro">Digite a descrição da tarefa.</div>
    <?php endif; ?>

    <?php if ($mensagemOk): ?>
        <div class="msg-ok">Tarefa adicionada!</div>
    <?php endif; ?>

    <h2>Nova Tarefa</h2>

    <form action="add_tarefa.php" method="POST">
        <input type="text" name="descricao" placeholder="Descrição da tarefa" required>
        <input type="date" name="data_vencimento">
        <button type="submit">Adicionar</button>
    </form>

    <h2>Pendentes</h2>

    <?php if (empty($tarefasPendentes)): ?>
        <p>Não há tarefas pendentes.</p>
    <?php else: ?>
        <?php foreach ($tarefasPendentes as $tarefa): ?>
            <div class="tarefa">
                <strong><?= htmlspecialchars($tarefa["descricao"]) ?></strong><br>
                Prazo: <?= $tarefa["data_vencimento"] ?: "—" ?><br><br>

                <form action="update_tarefa.php" method="POST">
                    <input type="hidden" name="id" value="<?= $tarefa["id"] ?>">
                    <button>Concluir</button>
                </form>

                <form action="delete_tarefa.php" method="POST">
                    <input type="hidden" name="id" value="<?= $tarefa["id"] ?>">
                    <button class="btn-excluir">Excluir</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <h2>Concluídas</h2>

    <?php foreach ($tarefasFeitas as $tarefa): ?>
        <div class="tarefa" style="background:#eee;">
            <strong style="text-decoration: line-through;">
                <?= htmlspecialchars($tarefa["descricao"]) ?>
            </strong><br>
            Prazo: <?= $tarefa["data_vencimento"] ?: "—" ?><br><br>

            <form action="delete_tarefa.php" method="POST">
                <input type="hidden" name="id" value="<?= $tarefa["id"] ?>">
                <button class="btn-excluir">Excluir</button>
            </form>
        </div>
    <?php endforeach; ?>

</div>

</body>
</html>
