<?php
require("../conexao.php");
session_start();

if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo'] != "entregador") {
    header("Location: ../ex2/login.php");
    exit;
}

$comando = "SELECT * FROM entregas WHERE id_entregador = :id_entregador AND status = 'em_rota' ORDER BY id ASC";
$stm = $conexao->prepare($comando);
$stm->execute([':id_entregador' => $_SESSION['id_usuario']]);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minhas entregas</title>
</head>
<body>
    <h1>Minhas entregas</h1>
    <?php while ($entrega = $stm->fetch(PDO::FETCH_ASSOC)) { ?>
        <div>
            <h2>Entrega #<?= $entrega['id'] ?></h2>
            <p>Dimensões: <?= $entrega['largura'] ?> x <?= $entrega['altura'] ?> x <?= $entrega['profundidade'] ?></p>
            <p>Peso: <?= $entrega['peso'] ?></p>
            <p>Conteúdo sensível: <?= $entrega['sensivel'] ? "Sim" : "Não" ?></p>
            <form action="marcar_entregue.php" method="post">
                <input type="hidden" name="id_entrega" value="<?= $entrega['id'] ?>">
                <input type="submit" value="Marcar como entregue">
            </form>
        </div>
        <hr>
    <?php } ?>
    <p><a href="../ex5/disponiveis.php">Ver entregas disponíveis</a></p>
    <p><a href="../sair.php">Sair</a></p>
</body>
</html>
