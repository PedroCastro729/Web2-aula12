<?php
require("../conexao.php");
session_start();

if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo'] != "entregador") {
    header("Location: ../ex2/login.php");
    exit;
}

$id_entrega = $_POST['id_entrega'];
$comando = "UPDATE entregas SET status = 'entregue' WHERE id = :id AND id_entregador = :id_entregador AND status = 'em_rota'";
$stm = $conexao->prepare($comando);
$stm->execute([
    ':id' => $id_entrega,
    ':id_entregador' => $_SESSION['id_usuario']
]);

header("Location: minhas_entregas.php");
exit;
?>
