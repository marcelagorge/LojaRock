<?php

require_once __DIR__ . '/../models/Product.php';

class ControladorAdmin {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    private function verificarAdmin() {
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            // Redirecionar não-admins para a página inicial ou mostrar um erro
            header('Location: ' . base_url('/'));
            exit();
        }
    }

    public function index() {
        $this->verificarAdmin();
        $produto = new Produto($this->db);
        $produtos = $produto->ler();
        require __DIR__ . '/../views/admin/index.php';
    }

    public function formularioCriar() {
        $this->verificarAdmin();
        require __DIR__ . '/../views/admin/create.php';
    }

    public function criar() {
        $this->verificarAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $produto = new Produto($this->db);
            $produto->nome = $_POST['name'];
            $produto->descricao = $_POST['description'];
            $produto->preco = $_POST['price'];

            if ($produto->criar()) {
                set_flash_message('Produto criado com sucesso.', 'success');
                header('Location: ' . base_url('admin/products'));
                exit();
            } else {
                set_flash_message('Erro ao criar produto.', 'danger');
                header('Location: ' . base_url('admin/products/create'));
                exit();
            }
        }
    }

    public function formularioEditar() {
        $this->verificarAdmin();
        $modelo_produto = new Produto($this->db);
        $modelo_produto->id = $_GET['id'];
        $produto = $modelo_produto->lerUm(); // Isso retorna um array
        require __DIR__ . '/../views/admin/edit.php';
    }

    public function atualizar() {
        $this->verificarAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $produto = new Produto($this->db);
            $produto->id = $_POST['id'];
            $produto->nome = $_POST['name'];
            $produto->descricao = $_POST['description'];
            $produto->preco = $_POST['price'];

            if ($produto->atualizar()) {
                set_flash_message('Produto atualizado com sucesso.', 'success');
                header('Location: ' . base_url('admin/products'));
                exit();
            } else {
                set_flash_message('Erro ao atualizar produto.', 'danger');
                header('Location: ' . base_url('admin/products/edit?id=' . $_POST['id']));
                exit();
            }
        }
    }

    public function excluir() {
        $this->verificarAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $produto = new Produto($this->db);
            $produto->id = $_POST['product_id'];

            if ($produto->excluir()) {
                set_flash_message('Produto excluído com sucesso.', 'success');
            } else {
                set_flash_message('Erro ao excluir produto.', 'danger');
            }
            header('Location: ' . base_url('admin/products'));
            exit();
        }
    }

}
