<?php

namespace App\Core;

class Controller
{
    protected function view(string $view, array $data = []): void
    {
        extract($data);
        $viewFile = VIEW_PATH . '/' . str_replace('.', '/', $view) . '.php';
        if (file_exists($viewFile)) {
            require $viewFile;
        } else {
            echo "Vista no encontrada: {$view}";
        }
    }

    protected function redirect(string $url): void
    {
        header("Location: {$url}");
        exit;
    }

    protected function json(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function auth(): void
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }
    }

    protected function role(string $role): void
    {
        $this->auth();
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== $role) {
            http_response_code(403);
            echo "Acceso denegado";
            exit;
        }
    }
}