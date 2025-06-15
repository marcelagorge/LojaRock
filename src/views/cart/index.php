<?php include __DIR__ . '/../layouts/header.php'; ?>

<h1>Carrinho de Compras</h1>

<?php if ($itens_carrinho->num_rows > 0): ?>
    <table class="table">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Preço</th>
                <th width="15%">Quantidade</th>
                <th>Subtotal</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $itens_carrinho->fetch_assoc()): ?>
                <?php
                    $subtotal = $row['preco'] * $row['quantidade'];
                    $preco_total += $subtotal;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['nome']); ?></td>
                    <td>R$<?php echo number_format($row['preco'], 2, ',', '.'); ?></td>
                    <td>
                        <form action="<?php echo base_url('cart/update'); ?>" method="POST" class="d-flex">
                            <input type="hidden" name="product_id" value="<?php echo $row['produto_id']; ?>">
                            <input type="number" name="quantity" value="<?php echo $row['quantidade']; ?>" min="1" class="form-control form-control-sm me-2" style="width: 70px;">
                            <button type="submit" class="btn btn-sm btn-info">Atualizar</button>
                        </form>
                    </td>
                    <td>R$<?php echo number_format($subtotal, 2, ',', '.'); ?></td>
                    <td>
                        <form action="<?php echo base_url('cart/remove'); ?>" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $row['produto_id']; ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Remover</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                <td colspan="2"><strong>R$<?php echo number_format($preco_total, 2, ',', '.'); ?></strong></td>
            </tr>
        </tfoot>
    </table>
<?php else: ?>
    <div class="alert alert-info">
        Seu carrinho está vazio no momento.
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
