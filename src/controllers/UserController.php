<?php

require_once __DIR__ . '/../models/User.php';

class ControladorUsuario {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function formularioRegistro() {
        require __DIR__ . '/../views/users/register.php';
    }

    public function formularioLogin() {
        require __DIR__ . '/../views/users/login.php';
    }

    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($this->db);
            $usuario->nome_usuario = $_POST['username'];
            $usuario->email = $_POST['email'];
            $usuario->senha = $_POST['password'];

            if ($usuario->criar()) {
                set_flash_message('Registro realizado com sucesso. Por favor, faça login.', 'success');
                header("Location: " . base_url('login'));
                exit();
            } else {
                set_flash_message('Erro: Não foi possível registrar o usuário.', 'danger');
                header("Location: " . base_url('register'));
                exit();
            }
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($this->db);
            $usuario->nome_usuario = $_POST['username'];
            $senha = $_POST['password'];

            $dados_usuario = $usuario->encontrarPorNomeUsuario();

            if ($dados_usuario && password_verify($senha, $dados_usuario['senha'])) {
                // Define variáveis de sessão
                $_SESSION['user_id'] = $dados_usuario['id'];
                $_SESSION['username'] = $dados_usuario['nome_usuario'];
                $_SESSION['role'] = $dados_usuario['funcao'];

                // Redireciona para a página de produtos
                set_flash_message('Bem-vindo de volta, ' . htmlspecialchars($dados_usuario['nome_usuario']) . '!', 'success');
                header("Location: " . base_url('products'));
                exit();
            } else {
                set_flash_message('Nome de usuário ou senha inválidos.', 'danger');
                header("Location: " . base_url('login'));
                exit();
            }
        }
    }

    public function sair() {
        // Remove todas as variáveis de sessão
        $_SESSION = array();

        // Destrói a sessão
        session_destroy();

        // Reinicia a sessão para armazenar mensagem flash
        session_start();
        set_flash_message('Você saiu com sucesso.', 'success');

        // Redireciona para página inicial
        header("Location: " . base_url('/'));
        exit();
    }
}
