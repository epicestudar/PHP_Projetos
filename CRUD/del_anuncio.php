<?php
require_once 'conectaBD.php';
session_start();
if (empty($_SESSION)) {
// Significa que as variáveis de SESSAO não foram definidas.
// Não poderia acessar aqui.
header("Location: index.php?msgErro=Você precisa se autenticar no sistema.");
die();
}

$result = array();
// Verificar se está chegando a informação (id_anuncio) pelo $_GET
if (!empty($_GET['id_anuncio'])) {
// Buscar as informações do anúncio a ser alterado (no banco de dados)
$sql = "SELECT * FROM anuncio WHERE email_usuario = :email AND id = :id";
try {
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':email' => $_SESSION['email'], ':id' => $_GET['id_anuncio']));
// Verificar se o usuário logado pode acessar/alterar as informações desse registro
// (id_anuncio)
if ($stmt->rowCount() == 1) {
// Registro obtido no banco de dados
$result = $stmt->fetchAll();
$result = $result[0]; // Informações do registro a ser alterado

}
else {
//die("Não foi encontrado nenhum registro para id_anuncio = " . $_GET['id_anuncio']
// . " e e-mail = " . $_SESSION['email']);
header("Location: index_logado.php?msgErro=Você não tem permissão para acessar esta
página");
die();
}
} catch (PDOException $e) {
header("Location: index_logado.php?msgErro=Falha ao obter registro no banco de
dados.");
//die($e->getMessage());
}
}
else {
    // Se entrar aqui, significa que $_GET['id_anuncio'] está vazio
    header("Location: index_logado.php?msgErro=Você não tem permissão para acessar esta
    página");
    die();
    }
    // Redirecionar (permissão)
    ?>
    <html lang="en" dir="ltr">
    <head>
    <meta charset="utf-8">
    <title>Apagar Anúncio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-
    +0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    </head>
    <body>
    <div class="container">
    <h1>Apagar Anúncio</h1>
    <form action="processa_anuncio.php" method="post">
    <div class="col-4">
    <label for="id_anuncio">ID</label>
    <input type="text" class="form-control" name="id_anuncio" id="id_anuncio"
    
    value="<?php echo $result['id']; ?>" readonly>
    </div>
    <div class="col-4">
    <label for="fase">Fase</label>
    <select class="form-select" name="fase" id="fase">
    <option disabled>Selecione a fase do animal</option>
    <option value="F" <?php echo $result['fase'] == 'F' ? "selected" : "disabled"
    
    ?>>Filhote</option>
    
    <option value="A" <?php echo $result['fase'] == 'A' ? "selected" : "disabled"
    
    ?>>Adulto</option>
    </select>
    </div>
    <div class="col-4">
    <label for="tipo">Tipo</label>
    <select class="form-select" name="tipo" id="tipo">
    <option disabled>Selecione o tipo do animal</option>
    <option value="G"
    <?php if ($result['tipo'] == 'G') {
    echo "selected";
    }
    else {
    echo "disabled";
} ?>>
Gato
</option>
<option value="C"
<?php if ($result['tipo'] == 'C') {
echo "selected";
}
else {
echo "disabled";
}?>>
Cachorro
</option>
</select>
</div>
<div class="col-4">
<label for="porte">Porte</label>
<select class="form-select" name="porte" id="porte">
<option disabled>Selecione o porte do animal</option>
<option value="P" <?php echo $result['porte'] == 'P' ? "selected" : "disabled"

?>>Pequeno</option>

<option value="M" <?php echo $result['porte'] == 'M' ? "selected" : "disabled"

?>>Médio</option>

<option value="G" <?php echo $result['porte'] == 'G' ? "selected" : "disabled"

?>>Grande</option>
</select>
</div>
<div class="col-4">
<label for="pelagemCor">Pelagem / Cor</label>
<input type="text" name="pelagemCor" id="pelagemCor" class="form-control"

value="<?php echo $result['pelagem_cor']; ?>" readonly>
</div>
<div class="col-4">
<label for="raca">Raça</label>
<input type="text" name="raca" id="raca" class="form-control" value="<?php echo

$result['raca']; ?>" readonly>
</div>
<div class="col-4">
<div class="form-check form-check-inline">
<input type="radio" class="form-check-input" name="sexo" value="M" id="sexoM"

<?php echo $result['sexo'] == 'M' ? "checked" : "disabled" ?>>
<label for="sexoM" class="form-check-label">Macho</label>
</div>
<div class="form-check form-check-inline">
<input type="radio" class="form-check-input" name="sexo" value="F" id="sexoF"

<?php echo $result['sexo'] == 'F' ? "checked" : "disabled" ?>>
<label for="sexoF" class="form-check-label">Fêmea</label>
</div>
</div>
<div class="col-4">
<label for="observacao">Observações</label>
<textarea name="observacao" class="form-control" id="observacao" rows="3"

readonly><?php echo $result['observacao']; ?></textarea>
</div>
<br />
<button type="submit" name="enviarDados" class="btn btn-primary"
value="DEL">Apagar</button>
<a href="index_logado.php" class="btn btn-danger">Cancelar</a>
</form>
</div>
</body>
</html>