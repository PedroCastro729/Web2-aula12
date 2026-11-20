<?php
require("../conexao.php");
session_start();

if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo'] != "gerente") {
    header("Location: ../ex2/login.php");
    exit;
}

$status = isset($_GET['status']) ? $_GET['status'] : "todos";

if ($status == "disponivel" || $status == "em_rota" || $status == "entregue" || $status == "cancelado") {
    $comando = "SELECT entregas.*, consumidor.nome AS nome_consumidor, entregador.nome AS nome_entregador FROM entregas INNER JOIN usuarios AS consumidor ON consumidor.id = entregas.id_consumidor LEFT JOIN usuarios AS entregador ON entregador.id = entregas.id_entregador WHERE entregas.status = :status ORDER BY entregas.id DESC";
    $stm = $conexao->prepare($comando);
    $stm->execute([':status' => $status]);
} else {
    $comando = "SELECT entregas.*, consumidor.nome AS nome_consumidor, entregador.nome AS nome_entregador FROM entregas INNER JOIN usuarios AS consumidor ON consumidor.id = entregas.id_consumidor LEFT JOIN usuarios AS entregador ON entregador.id = entregas.id_entregador ORDER BY entregas.id DESC";
    $stm = $conexao->query($comando);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel do gerente</title>
</head>
<body>
    <h1>Painel administrativo</h1>
    <p>Olá, <?= htmlspecialchars($_SESSION['nome']) ?></p>
    <form action="painel.php" method="get">
        <label>Filtrar por status:</label>
        <select name="status">
            <option value="todos" <?= $status == "todos" ? "selected" : "" ?>>Todos</option>
            <option value="disponivel" <?= $status == "disponivel" ? "selected" : "" ?>>Disponível</option>
            <option value="em_rota" <?= $status == "em_rota" ? "selected" : "" ?>>Em rota</option>
            <option value="entregue" <?= $status == "entregue" ? "selected" : "" ?>>Entregue</option>
            <option value="cancelado" <?= $status == "cancelado" ? "selected" : "" ?>>Cancelado</option>
        </select>
        <input type="submit" value="Filtrar">
    </form>
    <?php while ($entrega = $stm->fetch(PDO::FETCH_ASSOC)) { ?>
        <div>
            <h2>Entrega #<?= $entrega['id'] ?></h2>
            <p>Consumidor: <?= htmlspecialchars($entrega['nome_consumidor']) ?></p>
            <p>Entregador: <?= $entrega['nome_entregador'] ? htmlspecialchars($entrega['nome_entregador']) : "Não atribuído" ?></p>
            <p>Dimensões: <?= $entrega['largura'] ?> x <?= $entrega['altura'] ?> x <?= $entrega['profundidade'] ?></p>
            <p>Peso: <?= $entrega['peso'] ?></p>
            <p>Conteúdo sensível: <?= $entrega['sensivel'] ? "Sim" : "Não" ?></p>
            <p>Status: <?= htmlspecialchars($entrega['status']) ?></p>
            <form action="gerenciar.php" method="post">
                <input type="hidden" name="id_entrega" value="<?= $entrega['id'] ?>">
                <select name="acao">
                    <option value="cancelar">Cancelar</option>
                    <option value="excluir">Excluir</option>
                </select>
                <input type="submit" value="Executar">
            </form>
        </div>
        <hr>
    <?php } ?>
    <p><a href="../sair.php">Sair</a></p>
</body>
</html>
