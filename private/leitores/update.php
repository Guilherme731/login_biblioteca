<?php
include '../../config/db.php';
include '../funcoesPadrao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM leitores WHERE id_leitor = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $dado = mysqli_fetch_assoc($res);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    if (strlen($telefone) <= 13 && strlen($telefone) >= 9) {
        $id = $_GET['id'];
        $sql = "UPDATE leitores SET nome = '$nome', email = '$email', telefone  = '$telefone' WHERE id_leitor = $id";
        if ($conn->query($sql) === true) {
            echo "Leitor editado com sucesso.";
        } else {
            echo "Erro " . $sql . '<br>' . $conn->error;
        }
        $conn->close();
    } else {
        echo 'Digite um número de telefone válido.';
    }
}
?>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Atualizar Leitor</title>
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
    <h2>Atualizar Leitor:</h2>
    <form action="" method="post">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?= $dado['nome'] ?>" required>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?= $dado['email'] ?>" required>
        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" id="telefone" value="<?= $dado['telefone'] ?>" required>
        <button type="submit">Atualizar Leitor</button>
    </form>

</body>

</html>