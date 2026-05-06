<?php
require_once 'middleware.php';
require_once 'controller.php';

// router.php — Direciona requisições pelo método HTTP

class Router {

    public function despachar(): void {
        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'GET') {
            // Exibe o formulário
            require_once 'view.php';

        } elseif ($metodo === 'POST') {
            // Passa pelo Middleware primeiro
            $middleware = new Middleware();
            $middleware->validar($_POST);

            // Se chegou aqui, os dados são válidos — vai pro Controller
            $controller = new MatriculaController();
            $controller->processarMatricula($_POST);

        } else {
            http_response_code(405);
            echo "Método não permitido.";
        }
    }
}
