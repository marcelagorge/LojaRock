<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2>Gerenciar Produtos</h2>
<a href="<?php echo base_url('admin/products/create'); ?>" class="btn btn-success mb-3">Adicionar Novo Produto</a>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($produtos->num_rows > 0): ?>
            <?php while($row = $produtos->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['nome']); ?></td>
                    <td>R$<?php echo number_format($row['preco'], 2, ',', '.'); ?></td>
                    <td>
                        <a href="<?php echo base_url('admin/products/edit?id=' . $row['id']); ?>" class="btn btn-sm btn-primary">Editar</a>
                        <form action="<?php echo base_url('admin/products/delete'); ?>" method="POST" style="display:inline;">
                            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este produto?');">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Nenhum produto encontrado.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
