<?php
require("../conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = hash("sha256", $_POST['senha']);
$tipo = $_POST['tipo'];

if ($tipo != "consumidor" && $tipo != "entregador") {
    echo "Perfil inválido.";
    exit;
}

$comando = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES (:nome, :email, :senha, :tipo)";
$stm = $conexao->prepare($comando);
$stm->execute([
    ':nome' => $nome,
    ':email' => $email,
    ':senha' => $senha,
    ':tipo' => $tipo
]);

echo "Usuário cadastrado com sucesso.";
echo "<br><a href='../ex2/login.php'>Ir para login</a>";
?>
