<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2>Editar Produto</h2>

<form action="<?php echo base_url('admin/products/edit'); ?>" method="POST">
    <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
    <div class="mb-3">
        <label for="name" class="form-label">Nome do Produto</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($produto['nome']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Descrição</label>
        <textarea class="form-control" id="description" name="description" rows="3"><?php echo htmlspecialchars($produto['descricao']); ?></textarea>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Preço</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo $produto['preco']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Atualizar Produto</button>
</form>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
