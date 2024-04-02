CREATE TABLE IF NOT EXISTS contatos (
    id_contato INT NOT NULL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email varchar (255) NOT NULL,
    cel VARCHAR(255) NOT NULL,
    pizza VARCHAR(255) NOT NULL,
    cadastro date not null DEFAULT CURRENT_TIMESTAMP
)

INSERT INTO contatos (id_contato, nome, email, cel, pizza) VALUES
(1, 'João Silva', 'joao@example.com', '+5511999999999', 'Calabresa'),
(2, 'Maria Souza', 'maria@example.com', '+5511888888888', 'Marguerita'),
(3, 'Carlos Oliveira', 'carlos@example.com', '+5511777777777', 'Quatro Queijos'),
(4, 'Ana Santos', 'ana@example.com', '+5511666666666', 'Frango com Catupiry');