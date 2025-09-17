<?php
include('config/db.php');
session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

if(isset($_SESSION['email'])){
    header("Location: private/emprestimos/read.php");
}

$msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = $_POST["email"] ?? "";
    $pass = $_POST["password"] ?? "";

    $stmt = $conn->prepare("SELECT id, email, senha FROM usuarios WHERE email=?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    $dados = $result->fetch_assoc();
    $stmt->close();
    
    if (password_verify($pass, $dados['senha'])) {
        $_SESSION["user_id"] = $dados["id"];
        $_SESSION["email"] = $dados["email"];
        header("Location: private/emprestimos/read.php");
        exit;
    } else {
        $msg = "Usuário ou senha incorretos!";
    }
}


?>

<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="private/style/style.css">
    <title>Login - Biblioteca</title>
</head>
<body>
    <h1>Biblioteca</h1>
    <p>Bem vindo ao sistema de gerenciamento de biblioteca! Faça login abaixo.</p><br>
    <?php if ($msg): ?><p class="alert alert-warning" role="alert" style="width: fit-content;"><?= $msg ?></p><?php endif; ?>
    <form action="" method="post">
        <input type="email" name="email" id="email" placeholder="E-mail">
        <input type="password" name="password" id="password" placeholder="Senha">
        <button type="submit">Login</button>
    </form>

    <p class="alert alert-info" role="alert" style="width: fit-content;">
        Sistema de teste, utilize o e-mail teste@biblioteca.com e a senha Teste_123
    </p>
</body>
</html>