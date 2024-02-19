<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Página Inicial - Ambiente Logado</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
rel="stylesheet" integrity="sha384-
+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<?php
require_once 'conectaBD.php';
session_start();
if (empty($_SESSION)) {
// Significa que as variáveis de SESSAO não foram definidas.
// Não pode acessar aqui. o sistema manda voltar para a pagina de login
header("Location: index.php?msgErro=Você precisa se autenticar no sistema.");
die();
}
?>
<body>
<div class="container">
<?php if (!empty($_GET['msgErro'])) { ?>
<div class="alert alert-warning" role="alert">
<?php echo $_GET['msgErro']; ?>
</div>
<?php } ?>
<?php if (!empty($_GET['msgSucesso'])) { ?>
<div class="alert alert-success" role="alert">
<?php echo $_GET['msgSucesso']; ?>
</div>
<?php } ?>
</div>
<div class="container">
<div class="col-md-11">

<h2 class="title">Olá <i><?php echo $_SESSION['nome']; ?></i>, seja bem-
vindo(a)!</h2>

</div>
</div>
<div class="container">
<a href="cad_anuncio.php" class="btn btn-primary">Novo Anúncio</a>
<a href="index_logado.php?meus_anuncios=1" class="btn btn-success">Meus Anúncios</a>
<a href="index_logado.php?meus_anuncios=0" class="btn btn-info">Todos Anúncios</a>
<a href="logout.php" class="btn btn-dark">Sair</a>
</div>
</body>
</html>