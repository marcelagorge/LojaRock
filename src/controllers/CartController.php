<?php

require_once __DIR__ . '/../models/Cart.php';

class ControladorCarrinho {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    private function verificarAutenticacao() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . base_url('login'));
            exit();
        }
    }

    public function index() {
        $this->verificarAutenticacao();
        $usuario_id = $_SESSION['user_id'];

        $carrinho = new Carrinho($this->db);
        $carrinho->usuario_id = $usuario_id;

        // Buscar itens do carrinho
        $itens_carrinho = $carrinho->obterItensCarrinho();
        $preco_total = 0;

        // Carrega a view e passa os itens do carrinho
        require __DIR__ . '/../views/cart/index.php';
    }

    public function atualizar() {
        $this->verificarAutenticacao();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $carrinho = new Carrinho($this->db);
            $carrinho->usuario_id = $_SESSION['user_id'];

            if ($carrinho->atualizarQuantidade($_POST['product_id'], $_POST['quantity'])) {
                set_flash_message('Carrinho atualizado com sucesso.', 'success');
            } else {
                set_flash_message('Falha ao atualizar o carrinho.', 'danger');
            }
            header("Location: " . base_url('cart'));
            exit();
        }
    }

    public function remover() {
        $this->verificarAutenticacao();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $carrinho = new Carrinho($this->db);
            $carrinho->usuario_id = $_SESSION['user_id'];

            if ($carrinho->removerItem($_POST['product_id'])) {
                set_flash_message('Item removido do carrinho.', 'success');
            } else {
                set_flash_message('Falha ao remover item do carrinho.', 'danger');
            }
            header("Location: " . base_url('cart'));
            exit();
        }
    }

    public function adicionar() {
        $this->verificarAutenticacao();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['product_id']) || !isset($_POST['quantity'])) {
                set_flash_message('Solicitação inválida. Informação do produto ausente.', 'danger');
                header('Location: ' . base_url('products'));
                exit();
            }

            // Obter product_id e quantidade do formulário
            $produto_id = $_POST['product_id'];
            $quantidade = (int)$_POST['quantity'];

            // Instanciar objeto Carrinho
            $carrinho = new Carrinho($this->db);
            $carrinho->usuario_id = $_SESSION['user_id'];
            $carrinho->produto_id = $produto_id;
            $carrinho->quantidade = $quantidade;

            // Adicionar ao carrinho
            if ($carrinho->adicionarAoCarrinho()) {
                set_flash_message('Item adicionado ao carrinho com sucesso!', 'success');
            } else {
                set_flash_message('Erro: Não foi possível adicionar o item ao carrinho.', 'danger');
            }
            header("Location: " . base_url('products'));
            exit();
        }
    }
}
