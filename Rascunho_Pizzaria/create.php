
<?php
include 'functions.php';
$pdo = pdo_connect_pgsql();
$msg = '';
// Verifica se os dados POST não estão vazios
if (!empty($_POST)) {
    // Se os dados POST não estiverem vazios, insere um novo registro
    // Configura as variáveis que serão inserid_contatoas. Devemos verificar se as variáveis POST existem e, se não existirem, podemos atribuir um valor padrão a elas.
    $id_contato = isset($_POST['id_contato']) && !empty($_POST['id_contato']) && $_POST['id_contato'] != 'auto' ? $_POST['id_contato'] : NULL;
    // Verifica se a variável POST "nome" existe, se não existir, atribui o valor padrão para vazio, basicamente o mesmo para todas as variáveis
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $cel = isset($_POST['cel']) ? $_POST['cel'] : '';
    $pizza = isset($_POST['pizza']) ? $_POST['pizza'] : '';
    $cadastro = isset($_POST['cadastro']) ? $_POST['cadastro'] : date('Y-m-d H:i:s');
    // Insere um novo registro na tabela contacts
    $stmt = $pdo->prepare('INSERT INTO contatos (id_contato, nome, email, cel, pizza, cadastro) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id_contato, $nome, $email, $cel, $pizza, $cadastro]);
    // Mensagem de saída
    $msg = 'Pedido Realizado com Sucesso!';
}
?>


<?=template_header('Cadastro de Pedidos')?>

<div class="content update">
	<h2>Registrar Pedido</h2>
    <form action="create.php" method="post">
        <label for="id_contato">ID</label>
        <label for="nome">Nome</label>
        <input type="text" name="id_contato" placeholder="" value="" id_contato="id_contato" >
        <input type="text" name="nome" placeholder="Seu Nome" id_contato="nome">
        <label for="email">Email</label>
        <label for="cel">Celular</label>
        <input type="text" name="email" placeholder="seuemail@seuprovedor.com.br" id_contato="email">
        <input type="text" name="cel" placeholder="(XX) X.XXXX-XXXX" id_contato="cel">
        <label for="pizza">Pizza</label>
        <label for="cadastro">Data do Pedido</label>
        <input type="text" name="pizza" placeholder="Pizza" id_contato="pizza">
        <input type="datetime-local" name="Criar" value="<?=date('Y-m-d\TH:i')?>" id_contato="cadastro">
        <input type="submit" value="Criar">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>