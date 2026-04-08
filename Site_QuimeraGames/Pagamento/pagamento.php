<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento - QuimeraGames</title>
    <link rel="stylesheet" href="pagamento.css">
</head>

<body>

    <header class="topo">
    <div class="topo-esquerda">
      <a href="http://localhost/GitHub/ProjIntegrador/Site_QuimeraGames/Index/index.php">
          <img class="logo"
          src="../imagens/logo.png"></a>
      <a href="http://localhost/GitHub/ProjIntegrador/Site_QuimeraGames/Index/index.php"><button
          class="btn-nav active">Loja</button></a>
    </div>
    <div class="topo-direita">
      <a href="http://localhost/GitHub/ProjIntegrador/Site_QuimeraGames/Entrar/Entrar.php"><button
          class="btn-dropdown">Entrar</button></a>
      <a href="http://localhost/GitHub/ProjIntegrador/Site_QuimeraGames/Sac/Suporte.php"><button
          class="btn-dropdown">Suporte</button></a>
    </div>
  </header>

    <div class="container">
        <nav class="menu-busca">
            <div class="busca-input">
                <span>🔍</span>
                <input type="text" placeholder="Pesquisar loja">
            </div>
            <button class="btn-dropdown">Explorar ▾</button>
            <button class="btn-dropdown">Categorias ▾</button>
        </nav>

        <main class="main-pagamento">
            <div class="col-dados">
                <h1>Configurações de pagamento</h1>
                <p class="descricao-pagamento">Aqui você pode configurar formas de pagamento, visualizar seu saldo e gerencia-lo.</p>

                <div class="saldo-container">
                    <span class="label-saldo">Saldo da conta</span>
                    <h2 class="valor-saldo">R$ 0,00</h2>
                </div>

                <form id="form-pagamento" class="metodos-pagamento">
                    <h3>Selecione o método de pagamento</h3>

                    <label class="metodo-card">
                        <input type="radio" name="metodo" value="cartao" checked>
                        <span class="icon-placeholder">💳</span>
                        <span>Cartão de crédito</span>
                    </label>

                    <label class="metodo-card">
                        <input type="radio" name="metodo" value="pix">
                        <span class="icon-placeholder">💠</span>
                        <span>Pix</span>
                    </label>

                    <label class="metodo-card">
                        <input type="radio" name="metodo" value="boleto">
                        <span class="icon-placeholder">📄</span>
                        <span>Boleto</span>
                    </label>

                    <div id="dados-cartao" class="form-dinamico ativo">
                        <input type="text" placeholder="Número do Cartão" class="input-form">
                        <input type="text" placeholder="Nome impresso no cartão" class="input-form">
                        <div class="linha-inputs">
                            <input type="text" placeholder="MM/AA" class="input-form">
                            <input type="text" placeholder="CVV" class="input-form">
                        </div>
                    </div>

                    <div id="dados-pix" class="form-dinamico">
                        <p class="texto-info">Um QR Code será gerado para o pagamento via Pix. A aprovação é imediata.</p>
                    </div>

                    <div id="dados-boleto" class="form-dinamico">
                        <p class="texto-info">O boleto será gerado e enviado para seu e-mail. Pode levar até 3 dias úteis para compensar.</p>
                    </div>

                    <button type="button" class="btn-finalizar" onclick="alert('Simulação de compra concluída!')">Finalizar Compra</button>
                </form>
            </div>

            <div class="col-logo">
                <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=400&h=400&auto=format&fit=crop" alt="Capa do Jogo" class="imagem-jogo">
            </div>
        </main>

            <div class="col-logo">
                <div class="logo-grande-placeholder">
                    <span>Logo</span>
                </div>
            </div>
        </main>
    </div>

    <footer class="rodape">QuimeraGames &copy; 2026</footer>

    <?php
// Exemplo de lógica no topo do seu pagamento.php
session_start();

// Aqui você faria a conexão com seu banco de dados
// $pdo = new PDO("mysql:host=localhost;dbname=quimeragames", "root", "");

$preco_jogo = "0,00";
$imagem_jogo = "caminho/para/imagem_padrao.jpg";

// Verifica se veio um ID na URL
if (isset($_GET['id_jogo'])) {
    $id_jogo = $_GET['id_jogo'];
    
    // Simulação de uma busca no banco de dados:
    // $stmt = $pdo->prepare("SELECT preco, imagem_url FROM jogos WHERE id = :id");
    // $stmt->execute(['id' => $id_jogo]);
    // $jogo = $stmt->fetch();
    
    // Para testar sem banco, vamos simular que achou o jogo:
    $preco_jogo = "199,90"; 
    $imagem_jogo = "https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=400&h=400&auto=format&fit=crop"; 
}
?>

</body>

</html>