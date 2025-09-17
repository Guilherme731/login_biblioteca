<?php

include '../../config/db.php';
include '../funcoesPadrao.php';

$sqlAutores = "SELECT id_autor, nome FROM autores";
$resultAutores = $conn->query($sqlAutores);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $titulo = $_POST['titulo'];
    $genero = $_POST['genero'];
    $ano_publicacao = $_POST['ano_publicacao'];
    $autor = $_POST['autor'];

    $anoAtual = date("Y");
    if ($ano_publicacao <= 1500 || $ano_publicacao > $anoAtual) {
        echo "Erro: O ano de publicação deve ser maior que 1500 e menor ou igual ao ano atual";
        exit;
    }

    $sql = " INSERT INTO livros (titulo,genero,ano_publicacao, id_autor) VALUE ('$titulo','$genero',$ano_publicacao, $autor)";


    if ($conn->query($sql) === true) {
        echo "Novo livro registrado criado com sucesso.";
    } else {
        echo "Erro " . $sql . '<br>' . $conn->error;
    }
    $conn->close();
}

?>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Adicionar autor</title>
    <link rel="stylesheet" href="../styles.css">

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
                    <a class="nav-link" href="../leitores/read.php">Leitores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Livros</a>
                </li>
            </ul>
            <div class="d-flex">
                <a href="../../index.php?logout=1" class="btn btn-danger">Sair</a>
            </div>
        </div>
    </header>



    <div class="centro">
        <h1>Adicionar Livro</h1>
        <form method="POST" action="create.php">
            <div class="flex">
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" required>
                <label for="genero">Gênero:</label>
                <input type="text" name="genero">
                <label for="ano_publicacao">Ano de publicação:</label>
                <input type="number" name="ano_publicacao">
                <label for="autor">Autor:</label>
                <select name="autor">
                    <?php while ($row = $resultAutores->fetch_assoc()): ?>
                        <option value="<?= $row['id_autor'] ?>"><?= $row['nome'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit">Registrar Livro</button>

    </div>

    </form>


</body>


</html>