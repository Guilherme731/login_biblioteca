<?php

include '../../config/db.php';
include '../funcoesPadrao.php';

function buildQueryString($exclude = []) {
    $params = $_GET;
    foreach ($exclude as $param) {
        unset($params[$param]);
    }
    return http_build_query($params);
}


$sql = "SELECT id_livro, livros.titulo AS nome_livros, autores.nome AS nome_autores, titulo, genero, ano_publicacao FROM livros INNER JOIN autores ON autores.id_autor = livros.id_autor WHERE 1=1";


$pagina = 0;
$registroPorPagina = 10;
$resultado = mysqli_query($conn, $sql);
$num_linhas = mysqli_num_rows($resultado);
$total_paginas = $num_linhas / $registroPorPagina;
$total_paginas = ceil($total_paginas);

if($resultado->num_rows > 0){
if(isset($_GET['pagina'])){
    $pagina = $_GET['pagina'];
}
if($pagina < 0){
    $pagina = 0;
}

if($pagina >= $total_paginas){
    $pagina = $total_paginas - 1;
}

$paginaAnterior = $pagina -1;
$paginaPosterior = $pagina +1;

$index = $pagina * $registroPorPagina;

$sql .= " LIMIT $index, $registroPorPagina";

$result = $conn->query($sql);
}
?>

<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Jogadores</title>
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
    

<?php



if($resultado->num_rows > 0){
    $paginaExibida = $pagina + 1;
    $queryBase = buildQueryString(['pagina']);

$paginaAnteriorLink = "?$queryBase&pagina=$paginaAnterior";
$paginaPosteriorLink = "?$queryBase&pagina=$paginaPosterior";

echo "<a href='$paginaAnteriorLink'>Anterior</a> ";
echo "<a href='$paginaPosteriorLink'>Próxima</a>";
echo "<br> Página $paginaExibida de $total_paginas";
echo "<br> Total de $num_linhas resultados";

    echo "<table border = '1'>
        <tr>
            <th> Título </th>
            <th> Gênero </th>
            <th> Ano de Publicacao </th>
            <th> Autor </th>
            <th> Ações </th>
        </tr>
    ";
    while($row = $result->fetch_assoc()){

        echo "<tr>
                <td> {$row['nome_livros']} </td>
                <td> {$row['genero']} </td>
                <td> {$row['ano_publicacao']} </td>
                <td> {$row['nome_autores']} </td>
                <td>
                    <a href='update.php?id={$row['id_livro']}'>Atualizar</a>
                    <a href='delete.php?id={$row['id_livro']}'>Deletar</a>
                </td>
            </tr>
        ";
    }
    echo "</table>";
}else{
    echo "Nenhum livro encontrado.";    
}
echo "<a href='create.php'>Registrar livro</a>";

$conn -> close();

?>
</body>
</html>