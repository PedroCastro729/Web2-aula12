<?php
require("../conexao.php");
session_start();

if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo'] != "consumidor") {
    header("Location: ../ex2/login.php");
    exit;
}

$largura = $_POST['largura'];
$altura = $_POST['altura'];
$profundidade = $_POST['profundidade'];
$peso = $_POST['peso'];
$sensivel = $_POST['sensivel'];

if ($largura <= 0 || $altura <= 0 || $profundidade <= 0 || $peso <= 0 || ($sensivel != "0" && $sensivel != "1")) {
    echo "Dados inválidos.";
    exit;
}

$comando = "INSERT INTO entregas (id_consumidor, id_entregador, largura, altura, profundidade, peso, sensivel, status) VALUES (:id_consumidor, NULL, :largura, :altura, :profundidade, :peso, :sensivel, 'disponivel')";
$stm = $conexao->prepare($comando);
$stm->execute([
    ':id_consumidor' => $_SESSION['id_usuario'],
    ':largura' => $largura,
    ':altura' => $altura,
    ':profundidade' => $profundidade,
    ':peso' => $peso,
    ':sensivel' => $sensivel
]);

header("Location: ../ex4/minhas_solicitacoes.php");
exit;
?>
