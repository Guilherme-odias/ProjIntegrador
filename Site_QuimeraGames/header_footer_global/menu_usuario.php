<div id="user-menu-2" class="user-menu">
    <a href="../conta/conta.php">Conta</a>
    <a href="../pagamento/pagamento.php">Pagamento</a>
    <a href="../usuario_logado/wishlist.php">
        Lista de desejo
        <?php if (isset($qtd_wishlist) && $qtd_wishlist > 0): ?>
            <span class="badge-bolinha"><?php echo $qtd_wishlist; ?></span>
        <?php endif; ?>
    </a>
    <a href="../usuario_logado/meus_pedidos.php">Meus Pedidos</a>
    <a href="../usuario_logado/logout.php">Sair</a>
</div>