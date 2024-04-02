<?php
include 'functions.php';
$pdo = pdo_connect_pgsql();
$msg = '';
// Verifica se o ID do contato existe, por exemplo, update.php?id=1 irá obter o contato com o id 1
if (isset($_GET['id_contato'])) {
    if (!empty($_POST)) {
        // Esta parte é semelhante ao create.php, mas aqui estamos atualizando um registro e não inserindo
        $id_contato = isset($_POST['id_contato']) ? $_POST['id_contato'] : NULL;
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $cel = isset($_POST['cel']) ? $_POST['cel'] : '';
        $pizza = isset($_POST['pizza']) ? $_POST['pizza'] : '';
        $cadastro = isset($_POST['cadastro']) ? $_POST['cadastro'] : date('Y-m-d H:i:s');
        // Atualiza o registro
        $stmt = $pdo->prepare('UPDATE contatos SET id_contato = ?, nome = ?, email = ?, cel = ?, pizza = ?, cadastro = ? WHERE id_contato = ?');
        $stmt->execute([$id_contato, $nome, $email, $cel, $pizza, $cadastro, $_GET['id_contato']]);
        $msg = 'Atualização Realizada com Sucesso!';
    }
    // Obter o contato da tabela contatoss
    $stmt = $pdo->prepare('SELECT * FROM contatos WHERE id_contato = ?');
    $stmt->execute([$_GET['id_contato']]);
    $contatos = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contatos) {
        exit('Pedido Não Localizado!');
    }
} else {
    exit('Nenhum Pedido Especificada!');
}
?>


<?=template_header('Atualizar/Alterar Pedidos')?>

<div class="content update">
	<h2>Atualizar Contato ---- <?=$contatos['id_contato']?></h2>
    <form action="update.php?id_contato=<?=$contatos['id_contato']?>" method="post">
        <label for="id_contato">ID</label>
        <label for="nome">Nome</label>
        <input type="text" name="id" placeholder="" value="<?=$contatos['id_contato']?>" id="id_contato">
        <input type="text" name="nome" placeholder="Seu Nome" value="<?=$contatos['nome']?>" id="nome">
        <label for="email">Email</label>
        <label for="cel">Celular</label>
        <input type="text" name="email" placeholder="seuemail@seuprovedor.com.br" value="<?=$contatos['email']?>" id="email">
        <input type="text" name="cel" placeholder="(XX) X.XXXX-XXXX" value="<?=$contatos['cel']?>" id="cel">
        <label for="pizza">Pizza</label>
        <label for="created">Criação</label>
        <input type="text" name="pizza" placeholder="Pizza" value="<?=$contatos['pizza']?>" id="pizza">
        <input type="datetime-local" name="cadastro" value="<?=date('Y-m-d\TH:i', strtotime($contatos['cadastro']))?>" id="cadastro">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>