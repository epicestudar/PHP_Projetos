<?php
require_once 'conectaBD.php';
// Conectar ao BD (com o PHP)
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
die();
*/
// Verificar se está chegando dados por POST
if (!empty($_POST)) {
    // Iniciar SESSAO (session_start)
    session_start();
    try {
    // Montar a SQL
    $sql = "SELECT nome, email, telefone, data_nascimento FROM usuario WHERE email =
    :email AND senha = :senha";
    // Preparar a SQL (pdo)
    $stmt = $pdo->prepare($sql);
    // Definir/Organizar os dados p/ SQL
    $dados = array(
    ':email' => $_POST['email'],
    ':senha' => md5($_POST['senha'])
    );
    $stmt->execute($dados);
    //$stmt->execute(array(':email' => $_POST['email'], ':senha' => $_POST['senha']));
    $result = $stmt->fetchAll();
    if ($stmt->rowCount() == 1) { // Se o resultado da consulta SQL trouxer um registro
    // Autenticação foi realizada com sucesso
    $result = $result[0];
    // Definir as variáveis de sessão
    $_SESSION['nome'] = $result['nome'];
    $_SESSION['email'] = $result['email'];
    $_SESSION['data_nascimento'] = $result['data_nascimento'];
    $_SESSION['telefone'] = $result['telefone'];
    // Redirecionar p/ página inicial (ambiente logado)
    header("Location: index_logado.php");
    } else { // Signifca que o resultado da consulta SQL não trouxe nenhum registro
    // Falha na autenticaçao
    // Destruir a SESSAO
    session_destroy();
    // Redirecionar p/ página inicial (login)
    header("Location: index.php?msgErro=E-mail e/ou Senha inválido(s).");
    }
    } catch (PDOException $e) {
    die($e->getMessage());
    }
    }
    else {
        header("Location: index.php?msgErro=Você não tem permissão para acessar esta página..");
        }
        die();
        ?>