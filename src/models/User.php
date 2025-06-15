<?php

class Usuario {
    private $conn;
    private $nome_tabela = "usuarios";

    // Propriedades do Objeto
    public $id;
    public $nome_usuario;
    public $email;
    public $senha;
    public $data_criacao;

    /**
     * Construtor com conexão ao banco de dados
     * @param $db
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Criar um novo usuário
     * @return bool
     */
    public function criar() {
        $query = "INSERT INTO " . $this->nome_tabela . " SET nome_usuario = ?, email = ?, senha = ?";
        $stmt = $this->conn->prepare($query);

        // Sanitiza entrada
        $this->nome_usuario = htmlspecialchars(strip_tags($this->nome_usuario));
        $this->email = htmlspecialchars(strip_tags($this->email));

        // Criptografa a senha
        $senha_hash = password_hash($this->senha, PASSWORD_BCRYPT);

        // Vincula parâmetros
        $stmt->bind_param('sss', $this->nome_usuario, $this->email, $senha_hash);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Encontrar um usuário pelo seu nome de usuário
     * @return array|null
     */
    public function encontrarPorNomeUsuario() {
        $query = "SELECT id, nome_usuario, senha, funcao FROM " . $this->nome_tabela . " WHERE nome_usuario = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);

        // Sanitiza
        $this->nome_usuario = htmlspecialchars(strip_tags($this->nome_usuario));

        // Vincula nome de usuário
        $stmt->bind_param('s', $this->nome_usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }
}
