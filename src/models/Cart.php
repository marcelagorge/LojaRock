<?php

class Carrinho {
    private $conn;
    private $nome_tabela = "carrinho_compras";

    // Propriedades do Objeto
    public $id;
    public $usuario_id;
    public $produto_id;
    public $quantidade;
    public $adicionado_em;

    /**
     * Construtor com conexão ao banco de dados
     * @param $db
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Adiciona um produto ao carrinho. Se já existir, atualiza a quantidade.
     * @return bool
     */
    public function adicionarAoCarrinho() {
        $query = "SELECT id, quantidade FROM " . $this->nome_tabela . " WHERE usuario_id = ? AND produto_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $this->usuario_id, $this->produto_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Produto existe, adiciona à quantidade existente
            $row = $result->fetch_assoc();
            $nova_quantidade = $row['quantidade'] + $this->quantidade;
            return $this->atualizarQuantidade($this->produto_id, $nova_quantidade);
        } else {
            // Produto não existe, insere novo registro
            $query = "INSERT INTO " . $this->nome_tabela . " (usuario_id, produto_id, quantidade) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('iii', $this->usuario_id, $this->produto_id, $this->quantidade);
            return $stmt->execute();
        }
    }

    /**
     * Obtém todos os itens do carrinho de um usuário, juntando com a tabela de produtos para detalhes.
     * @return mysqli_result
     */
    public function obterItensCarrinho() {
        $query = "SELECT p.id as produto_id, p.nome, p.preco, sc.quantidade 
                  FROM " . $this->nome_tabela . " sc
                  JOIN produtos p ON sc.produto_id = p.id
                  WHERE sc.usuario_id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $this->usuario_id);
        $stmt->execute();
        
        return $stmt->get_result();
    }

    /**
     * Atualiza a quantidade de um item específico no carrinho.
     * @param int $produto_id
     * @param int $quantidade
     * @return bool
     */
    public function atualizarQuantidade($produto_id, $quantidade) {
        $query = "UPDATE " . $this->nome_tabela . " SET quantidade = ? WHERE usuario_id = ? AND produto_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('iii', $quantidade, $this->usuario_id, $produto_id);
        return $stmt->execute();
    }

    /**
     * Remove um item do carrinho.
     * @param int $produto_id
     * @return bool
     */
    public function removerItem($produto_id) {
        $query = "DELETE FROM " . $this->nome_tabela . " WHERE usuario_id = ? AND produto_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ii', $this->usuario_id, $produto_id);
        return $stmt->execute();
    }

    /**
     * Limpa todos os itens do carrinho de um usuário.
     * @return bool
     */
    public function limparCarrinho() {
        $query = "DELETE FROM " . $this->nome_tabela . " WHERE usuario_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $this->usuario_id);
        return $stmt->execute();
    }
}
