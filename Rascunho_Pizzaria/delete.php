
<?php
include 'functions.php';
$pdo = pdo_connect_pgsql();
$msg = '';
// Verifica se o ID do contato existe
if (isset($_GET['id_contato'])) {
    // Seleciona o registro que será deletado
    $stmt = $pdo->prepare('SELECT * FROM contatos WHERE id_contato = ?');
    $stmt->execute([$_GET['id_contato']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contato Não Localizado!');
    }
    // Certifique-se de que o usuário confirma antes da exclusão
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // O usuário clicou no botão "Sim", deleta o registro
            $stmt = $pdo->prepare('DELETE FROM contatos WHERE id_contato = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'Contato Apagado com Sucesso!';
        } else {
            // O usuário clicou no botão "Não", redireciona de volta para a página de leitura
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('Nenhum ID especificado!');
}
?>


<?=template_header('Apagar Usuários')?>

<div class="content delete">
	<h2>Apagar Contato ----  <?=$contact['nome']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Você tem certeza que deseja apagar o contato #<?=$contact['id_contato']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$contact['id_contato']?>&confirm=yes">Sim</a>
        <a href="delete.php?id=<?=$contact['id_contato']?>&confirm=no">Não</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>