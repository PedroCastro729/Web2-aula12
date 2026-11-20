<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
</head>
<body>
    <h1>Cadastro de usuário</h1>
    <form action="salva.php" method="post">
        <label>Nome:</label>
        <input type="text" name="nome" required>
        <br><br>
        <label>E-mail:</label>
        <input type="email" name="email" required>
        <br><br>
        <label>Senha:</label>
        <input type="password" name="senha" required>
        <br><br>
        <label>Perfil:</label>
        <select name="tipo" required>
            <option value="consumidor">Consumidor</option>
            <option value="entregador">Entregador</option>
        </select>
        <br><br>
        <input type="submit" value="Cadastrar">
    </form>
    <p><a href="../ex2/login.php">Fazer login</a></p>
</body>
</html>
