<?php

include '../../config/db.php';
include '../funcoesPadrao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    if(strlen($telefone) <= 13 && strlen($telefone) >= 9){
        $sql = "INSERT INTO leitores(nome, email, telefone) VALUES ('$nome', '$email', '$telefone')";

        if ($conn->query($sql) === true) {
        echo "Leitor registrado criado com sucesso.";
        } else {
        echo "Erro " . $sql . '<br>' . $conn->error;
        }
        $conn->close();
    }else{
        echo 'Digite um número de telefone válido.';
    }
    
}

?>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Adicionar Leitor</title>
</head>

<body>
    <header class="navbar navbar-expand-lg bg-body-secondary">
        <div class="container-fluid">
            <span class="navbar-brand"><?= $_SESSION['email'] ?></span>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="../emprestimos/read.php">Empréstimos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../autores/read.php">Autores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Leitores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../livros/read.php">Livros</a>
                </li>
            </ul>
            <div class="d-flex">
                <a href="../../index.php?logout=1" class="btn btn-danger">Sair</a>
            </div>
        </div>
    </header>

    <form method="POST" action="create.php">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" id="telefone" required>

        <button type="submit">Registrar Leitor</button>

    </form>

</body>

</html>