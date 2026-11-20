<?php
require("../conexao.php");
session_start();

if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo'] != "entregador") {
    header("Location: ../ex2/login.php");
    exit;
}

$id_entrega = $_POST['id_entrega'];

$comando = "UPDATE entregas SET id_entregador = :id_entregador, status = 'em_rota' WHERE id = :id AND status = 'disponivel' AND id_entregador IS NULL";
$stm = $conexao->prepare($comando);
$stm->execute([
    ':id_entregador' => $_SESSION['id_usuario'],
    ':id' => $id_entrega
]);

if ($stm->rowCount() > 0) {
    header("Location: ../ex6/minhas_entregas.php");
    exit;
}

echo "Esta entrega não está mais disponível.";
echo "<br><a href='disponiveis.php'>Voltar</a>";
?>
