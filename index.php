<?php
session_start();

// Ponto de entrada principal e roteador

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/src/helpers/flash.php';
require_once __DIR__ . '/src/helpers/url_helper.php';
require_once __DIR__ . '/src/controllers/ProductController.php';
require_once __DIR__ . '/src/controllers/UserController.php';
require_once __DIR__ . '/src/controllers/CartController.php';
require_once __DIR__ . '/src/controllers/AdminController.php';

// Obter conexão com banco de dados
$db = obterConexaoDB();

// Roteamento básico
$base_path = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2)[0];

// Remover caminho base do URI requisitado
if ($base_path && strpos($request_uri, $base_path) === 0) {
    $request_uri = substr($request_uri, strlen($base_path));
}

if (empty($request_uri)) {
    $request_uri = '/';
}

switch ($request_uri) {
    case '/':
        // Página inicial
        require __DIR__ . '/src/views/layouts/header.php';
        echo "<h1>Bem-vindo à Loja Virtual</h1>";
        require __DIR__ . '/src/views/layouts/footer.php';
        break;
    case '/products':
        $controller = new ControladorProduto($db);
        $controller->index();
        break;
    case '/register':
        $controller = new ControladorUsuario($db);
        $controller->formularioRegistro();
        break;
    case '/login':
        $controller = new ControladorUsuario($db);
        $controller->formularioLogin();
        break;
    case '/users/register':
        $controller = new ControladorUsuario($db);
        $controller->registrar();
        break;
    case '/users/login':
        $controller = new ControladorUsuario($db);
        $controller->login();
        break;
    case '/logout':
        $controller = new ControladorUsuario($db);
        $controller->sair();
        break;

    // Rotas de Admin
    case '/admin/products':
        $controller = new ControladorAdmin($db);
        $controller->index();
        break;
    case '/admin/products/create':
        $controller = new ControladorAdmin($db);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->criar();
        } else {
            $controller->formularioCriar();
        }
        break;
    case '/admin/products/edit':
        $controller = new ControladorAdmin($db);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->atualizar();
        } else {
            $controller->formularioEditar();
        }
        break;
    case '/admin/products/delete':
        $controller = new ControladorAdmin($db);
        $controller->excluir();
        break;
    case '/cart':
        $controller = new ControladorCarrinho($db);
        $controller->index();
        break;
    case '/cart/add':
        $controller = new ControladorCarrinho($db);
        $controller->adicionar();
        break;
    case '/cart/update':
        $controller = new ControladorCarrinho($db);
        $controller->atualizar();
        break;
    case '/cart/remove':
        $controller = new ControladorCarrinho($db);
        $controller->remover();
        break;

    default:
        http_response_code(404);
        echo "<h1>404 Página Não Encontrada</h1>";
        break;
}
