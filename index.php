<?php
include('config/db.php');

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}


$msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = $_POST["email"] ?? "";
    $pass = $_POST["password"] ?? "";

    $stmt = $mysqli->prepare("SELECT id, email, senha FROM usuarios WHERE email=? AND senha=?");
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();
    $dados = $result->fetch_assoc();
    $stmt->close();

    if ($dados) {
        $_SESSION["user_id"] = $dados["id"];
        $_SESSION["email"] = $dados["email"];
        header("Location: public/emprestimos/read.php");
        exit;
    } else {
        $msg = "Usuário ou senha incorretos!";
    }
}


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="public/style/style.css">
    <title>Login - Biblioteca</title>
</head>
<body>
    <h1>Biblioteca</h1>
    <p>Bem vindo ao sistema de gerenciamento de biblioteca! Faça login abaixo.</p>
    <form action="" method="post">
        <input type="email" name="email" id="email" placeholder="E-mail">
        <input type="password" name="password" id="password" placeholder="Senha">
        <button type="submit">Login</button>
    </form>
</body>
</html>