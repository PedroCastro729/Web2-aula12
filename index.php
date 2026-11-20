<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ex1/cadastro.php");
    exit;
}

if ($_SESSION['tipo'] == "consumidor") {
    header("Location: ex3/nova_entrega.php");
    exit;
}

if ($_SESSION['tipo'] == "entregador") {
    header("Location: ex5/disponiveis.php");
    exit;
}

if ($_SESSION['tipo'] == "gerente") {
    header("Location: ex7/painel.php");
    exit;
}
?>
