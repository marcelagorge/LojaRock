<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="row">
    <div class="col-md-12">
        <h1>Produtos</h1>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-8 offset-md-2">
        <form action="<?php echo base_url('products'); ?>" method="GET" class="d-flex">
            <input type="search" name="q" class="form-control me-2" placeholder="Buscar produtos por nome ou descrição..." value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>" aria-label="Buscar">
            <button class="btn btn-outline-light" type="submit">Buscar</button>
        </form>
    </div>
</div>

<div class="row">
    <?php if ($produtos->num_rows > 0): ?>
        <?php while ($row = $produtos->fetch_assoc()): ?>
            <?php extract($row); ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($nome); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($descricao); ?></p>
                        <p class="card-text"><strong>Preço:</strong> R$<?php echo htmlspecialchars($preco); ?></p>
                        <form action="<?php echo base_url('cart/add'); ?>" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                            <input type="number" name="quantity" value="1" min="1" class="form-control mb-2" style="width: 70px;">
                            <button type="submit" class="btn btn-primary">Adicionar ao Carrinho</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="col-md-12">
            <p>Nenhum produto encontrado.</p>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
