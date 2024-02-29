<?php
require_once 'conectaBD.php';
// Definir o BD (e a tabela)
// Conectar ao BD (com o PHP)
session_start();
if (empty($_SESSION)) {
// Significa que as variáveis de SESSAO não foram definidas.
// Não poderia acessar aqui.
header("Location: index.php?msgErro=Você precisa se autenticar no sistema.");
die();
}

if (!empty($_POST)) {
// Está chegando dados por POST e então posso tentar inserir no banco
// Obter as informações do formulário ($_POST)
// Verificar se estou tentando INSERIR (CAD) /
if ($_POST['enviarDados'] == 'CAD') { // CADASTRAR!!!
    try {
    // Preparar as informações
    // Montar a SQL (pgsql)
    $sql = "INSERT INTO anuncio
    
    (fase, tipo, porte, sexo, pelagem_cor, raca, observacao, email_usuario)
    VALUES
    (:fase, :tipo, :porte, :sexo, :pelagem_cor, :raca, :observacao,
    
    :email_usuario)";
    // Preparar a SQL (pdo)
    $stmt = $pdo->prepare($sql);
    // Definir/organizar os dados p/ SQL
    $dados = array(
    ':fase' => $_POST['fase'],
    ':tipo' => $_POST['tipo'],
    ':porte' => $_POST['porte'],
    ':sexo' => $_POST['sexo'],
    ':pelagem_cor' => $_POST['pelagemCor'],
    ':raca' => $_POST['raca'],
    ':observacao' => $_POST['observacao'],
    ':email_usuario' => $_SESSION['email']
    );
    // Tentar Executar a SQL (INSERT)
    // Realizar a inserção das informações no BD (com o PHP)
    if ($stmt->execute($dados)) {
    header("Location: index_logado.php?msgSucesso=Anúncio cadastrado com sucesso!");
    }
    } catch (PDOException $e) {
    die($e->getMessage());
    header("Location: index_logado.php?msgErro=Falha ao cadastrar anúncio..");
    }
    }
    // Inserir código do Alterar e Excluir
    else {
    header("Location: index_logado.php?msgErro=Erro de acesso (Operação não definida).");
    }
    }
    else {
    header("Location: index_logado.php?msgErro=Erro de acesso.");
    }
    die();
    // Redirecionar para a página inicial (index_logado) c/ mensagem erro/sucesso
    ?>
    
<html lang="en">
<head>
<meta charset="utf-8">
<title>Cadastrar Novo(a) Usuário(a)</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
rel="stylesheet" integrity="sha384-
+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
<!--
Nome Completo
Data de Nascimento
Telefone
E-mail
Senha
-->
<div class="container">
<h1>Cadastrar Novo(a) Usuário(a)</h1>
<form action="processa_usuario.php" method="post">
<div class="col-4">
<label for="nome">Nome Completo</label>
<input type="text" name="nome" id="nome" class="form-control">
</div>
<br>
<div class="col-4">
<label for="dataNascimento">Data de Nascimento</label>

<input type="date" name="dataNascimento" id="dataNascimento" class="form-
control" value="1980-01-01">

</div>
<br>
<div class="col-4">
<label for="telefone">Telefone para Contato</label>
<input type="tel" name="telefone" id="telefone" class="form-control">
</div>
<div class="col-4">
<label for="email">E-mail</label>
<input type="email" name="email" id="email" class="form-control">
</div>
<div class="col-4">
<label for="senha">Senha</label>
<input type="password" name="senha" id="senha" class="form-control">
</div><br>

<button type="submit" name="enviarDados" class="btn btn-primary">Cadastrar</button>

<a href="index.php" class="btn btn-danger">Cancelar</a>
</form>
</div>
</body>
</html>