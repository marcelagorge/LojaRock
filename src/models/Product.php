<?php

class Produto {
    private $conn;
    private $nome_tabela = "produtos";

    // Propriedades do Objeto
    public $id;
    public $nome;
    public $descricao;
    public $preco;
    public $data_criacao;

    /**
     * Construtor com conexão ao banco de dados
     * @param $db
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Lê todos os produtos do banco de dados
     * @return mysqli_result
     */
    public function ler() {
        $query = "SELECT id, nome, preco, descricao, data_criacao FROM " . $this->nome_tabela . " ORDER BY data_criacao DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    /**
     * Lê um único produto do banco de dados pelo seu ID.
     * @return array|null
     */
    public function lerUm() {
        $query = "SELECT id, nome, preco, descricao FROM " . $this->nome_tabela . " WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Busca produtos por palavra-chave.
     * @param string $palavras_chave
     * @return mysqli_result
     */
    public function buscar($palavras_chave) {
        // Sanitiza as palavras-chave
        $palavras_chave = htmlspecialchars(strip_tags($palavras_chave));
        $termo_busca = "%{$palavras_chave}%"; // Adiciona curingas para busca LIKE

        $query = "SELECT id, nome, preco, descricao, data_criacao 
                  FROM " . $this->nome_tabela . " 
                  WHERE nome LIKE ? OR descricao LIKE ? 
                  ORDER BY data_criacao DESC";

        $stmt = $this->conn->prepare($query);

        // Vincula as palavras-chave
        $stmt->bind_param("ss", $termo_busca, $termo_busca);

        $stmt->execute();
        return $stmt->get_result();
    }

    /**
     * Cria um novo produto
     * @return bool
     */
    public function criar() {
        $query = "INSERT INTO " . $this->nome_tabela . " (nome, preco, descricao) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        // Sanitiza entrada
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->preco = htmlspecialchars(strip_tags($this->preco));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));

        // Vincula valores
        $stmt->bind_param("sds", $this->nome, $this->preco, $this->descricao);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Atualiza um produto existente
     * @return bool
     */
    public function atualizar() {
        $query = "UPDATE " . $this->nome_tabela . " SET nome = ?, preco = ?, descricao = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        // Sanitiza entrada
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->preco = htmlspecialchars(strip_tags($this->preco));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Vincula parâmetros
        $stmt->bind_param('sdsi', $this->nome, $this->preco, $this->descricao, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Exclui um produto
     * @return bool
     */
    public function excluir() {
        $query = "DELETE FROM " . $this->nome_tabela . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        // Sanitiza
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Vincula o id do registro a ser excluído
        $stmt->bind_param('i', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
