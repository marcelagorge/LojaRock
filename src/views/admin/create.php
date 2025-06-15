<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2>Adicionar Novo Produto</h2>

<form action="<?php echo base_url('admin/products/create'); ?>" method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Nome do Produto</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Descrição</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Preço</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
    </div>
    <button type="submit" class="btn btn-primary">Criar Produto</button>
</form>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
