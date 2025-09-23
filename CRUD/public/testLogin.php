<?php
session_start();

// Conexão
$conn = new mysqli("localhost", "root", "", "cadastroUser");
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// --- LOGIN ou CADASTRO AUTOMÁTICO ---
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se já existe o usuário
    $sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";
    $res = $conn->query($sql);

    if ($res->num_rows > 0) {
        // Usuário existe → faz login
        $_SESSION['usuario'] = $email;
    } else {
        // Usuário não existe → cadastra
        $sqlInsert = "INSERT INTO usuarios (email, senha) VALUES ('$email', '$senha')";
        if ($conn->query($sqlInsert)) {
            $_SESSION['usuario'] = $email; // Já loga o novo usuário
        } else {
            $erro = "Erro ao cadastrar usuário!";
        }
    }
}

// --- LOGOUT ---
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Anotações</title>
</head>
<body>
<?php if (!isset($_SESSION['usuario'])): ?>

    <!-- Formulário de login/cadastro -->
    <h2>Login ou Cadastro</h2>
    <form method="POST">
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit" name="login">Entrar / Cadastrar</button>
    </form>
    <?php if (isset($erro)) echo "<p style='color:red'>$erro</p>"; ?>

<?php else: ?>

    <!-- Área do sistema (CRUD de anotações) -->
    <h2>Bem-vindo, <?php echo $_SESSION['usuario']; ?>!</h2>

    <!-- Form para nova anotação -->
    <form method="POST" action="salvar.php">
        <textarea name="texto" placeholder="Escreva sua anotação..."></textarea>
        <button type="submit">Salvar</button>
    </form>

    <!-- Listagem de anotações -->
    <h3>Minhas Anotações</h3>
    <?php
    $user = $_SESSION['usuario'];
    $sql = "SELECT * FROM anotacoes WHERE usuario='$user'";
    $res = $conn->query($sql);

    while ($row = $res->fetch_assoc()) {
        echo "<p>{$row['texto']}</p>";
    }
    ?>

    <!-- Logout -->
    <form method="POST">
        <button type="submit" name="logout">Sair</button>
    </form>

<?php endif; ?>
</body>
</html>