<?php

require_once('src/conexao-bd.php');

if (isset($_GET['id'])) {
    $iddousuario = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE idusuario = :id");
    $stmt->bindParam(':id', $iddousuario);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {

    } else {
        echo "Livro não encontrado.";
    }
} else {
    echo "ID do livro não fornecido.";
}

?>
<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="auto">

    <head><script src="../assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/album/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/dist/css/style.css" rel="stylesheet">
    </head>

<body>

    <header class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a href="index.php" class="navbar-brand d-flex align-items-center">
        </svg>
        <strong>Canto das Palavras</strong>
        </a>
        <ul class="nav">
        <?php 
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            }
            if(isset($_SESSION['idusuario'])){
                echo '<li class="nav-item">
                    <a class="nav-link btn btn-outline-light" href="cadastrousuarioadm.php">Adicionar Usuário</a>
                    </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-light" href="cadastrolivro.php">Adicionar livro</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link btn btn-outline-light" href="logout.php">Logout</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link btn btn-outline-light" href="admin.php">Gerênciamento da Loja</a>
                    </li>'
                    ;
            } else {
            echo '<li class="nav-item">
                    <a class="nav-link btn btn-outline-light" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link btn btn-outline-light" href="cadastrousuario.php">Cadastro</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link btn btn-outline-light" href="sobre.php">Sobre</a>
                    </li>'
                    ;
            }?>
        </ul>
    </div>
    </header>

<main>

    <section class="py-5 text-center container">
        <div class="row py-lg-3">
        <div class="col-lg-6 col-md-5 mx-auto">

            <p class="lead ">Editar usuário</p>
            <form action="editarusuariobd.php?id=<?= $usuario['idusuario']; ?>" method="POST" class="login-form">
            <div class="mb-3">
                <label for="nomeusuario" class="form-label">Nome</label>
                <input type="text" name="nomeusuario"  class="form-control" value="<?= $usuario['nomeusuario']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" value="<?= $usuario['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha:</label>
                <input type="password" name="senha"  class="form-control" value="<?= $usuario['senha']; ?>" required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary btn-sm">Confirmar</button>
            </div>
            <div>
            </div>
            <?php if(isset($error)){ echo "<p class='error'>$error</p>"; } ?>

            </form>
        </div>  
        </div>
    </section>

</main>

</body>
</html>