document.getElementById('searchForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    var saborPizza = document.getElementById('pizza').value;

    // Aqui você fará uma solicitação AJAX para o backend para buscar os dados do pedido
    // e exibir os resultados na página
    // Exemplo:
    fetch('buscar_cliente.php?pizza=' + encodeURIComponent(saborPizza))
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                document.getElementById('result').innerHTML = data.error;
            } else {
                // Construa a lista de pedidos
                var html = '<h2>Pedidos</h2>';
                html += '<ul>';
                data.forEach(function(contatos) {
                    html += '<li>ID do Cliente: ' + contatos.id_contato + '</li>';
                    html += '<li>Nome: ' + contatos.nome + '</li>';
                    html += '<li>Email: ' + contatos.email + '</li>';
                    html += '<li>Celular: ' + contatos.cel + '</li>';
                    html += '<li>Sabor da Pizza: ' + contatos.pizza + '</li>';
                    html += '<li>Hora: ' + contatos.cadastro + '</li>';
                    html += '<br>';
                });
                html += '</ul>';
                document.getElementById('result').innerHTML = html;
            }
        })
        .catch(error => {
            console.error('Erro ao buscar dados do pedido:', error);
        });
});