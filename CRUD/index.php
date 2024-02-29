<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Página Inicial</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
rel="stylesheet" integrity="sha384-
+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
<div class="container">
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

<h1>Olá, seja bem-vindo(a)!!</h1>
<form action="processa_login.php" method="post">
<div class="col-4">
<label for="email">E-mail</label>
<input type="email" name="email" id="email" class="form-control">
</div>
<div class="col-4">
<label for="senha">Senha</label>
<input type="password" name="senha" id="senha" class="form-control">
</div><br />

<button type="submit" name="enviarDados" class="btn btn-primary">Entrar</button>

<a href="cad_usuario.php" class="btn btn-warning">Cadastrar-se</a>
</form>
</div>
</body>
</html>