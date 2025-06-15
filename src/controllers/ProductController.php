<?php

require_once __DIR__ . '/../models/Product.php';

class ControladorProduto {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        // Instancia objeto produto
        $produto = new Produto($this->db);

        $consulta_busca = isset($_GET['q']) ? $_GET['q'] : '';

        if (!empty($consulta_busca)) {
            $produtos = $produto->buscar($consulta_busca);
        } else {
            // Consulta produtos
            $produtos = $produto->ler(); // Isto retorna o mysqli_result
        }

        // Carrega a view e passa os produtos
        require __DIR__ . '/../views/products/index.php';
    }

    // Outros métodos como mostrar(), criar(), armazenar(), editar(), atualizar(), excluir() irão aqui
}
