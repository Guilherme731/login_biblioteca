<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Excluir Livro</title>
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
    <h2>Excluir Livro</h2>
    <p>Deseja realmente excluir o livro?</p>
    <form action="" method="post">
        <button type="submit">Excluir</button>
    </form>
    <a href="read.php">Voltar</a>
    
</body>
</html>
    <?php
        include '../../config/db.php';
        include '../funcoesPadrao.php';

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $stmt = $conn->prepare("DELETE FROM livros WHERE id_livro = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                header("Location: read.php");
            }
        }else{
            header("Location: read.php");
        }
        
    ?>