<?php
// endereco
// nome do BD
// adm
// senha
$endereco = 'localhost';
$banco = 'postgres';
$adm = 'postgres';
$senha = 'dulcidia10';
try {
// sgbd:host;port;dbname
// adm
// senha
// errmode
$pdo = new PDO("pgsql:host=$endereco;port=5432;dbname=$banco", $adm, $senha,
[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
echo "Conectado no banco de dados!!!";
$sql = "CREATE TABLE IF NOT EXISTS usuario (ID SERIAL, NOME VARCHAR (255),
DATA_NASCIMENTO VARCHAR (255), TELEFONE VARCHAR (255),
EMAIL VARCHAR (255) PRIMARY KEY, SENHA VARCHAR (255))";
$stmt = $pdo-> prepare($sql);
$stmt->execute();

} catch (PDOException $e) {
echo "Falha ao conectar ao banco de dados. <br/>";
die($e->getMessage());
}
?>