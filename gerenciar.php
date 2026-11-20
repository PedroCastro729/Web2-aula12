<?php
require("../conexao.php");
session_start();

if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo'] != "gerente") {
    header("Location: ../ex2/login.php");
    exit;
}

$id_entrega = $_POST['id_entrega'];
$acao = $_POST['acao'];

if ($acao == "cancelar") {
    $comando = "UPDATE entregas SET status = 'cancelado' WHERE id = :id";
    $stm = $conexao->prepare($comando);
    $stm->execute([':id' => $id_entrega]);
} elseif ($acao == "excluir") {
    $comando = "DELETE FROM entregas WHERE id = :id";
    $stm = $conexao->prepare($comando);
    $stm->execute([':id' => $id_entrega]);
}

header("Location: painel.php");
exit;
?>
