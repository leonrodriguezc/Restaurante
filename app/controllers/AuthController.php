<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index(): void
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/menu');
        }
        $this->redirect('/login');
    }

    public function loginForm(): void
    {
        $title = 'Iniciar Sesión';
        $content = __DIR__ . '/../views/auth/login.php';
        require VIEW_PATH . '/layout.php';
    }

    public function registerForm(): void
    {
        $title = 'Registrarse';
        $content = __DIR__ . '/../views/auth/register.php';
        require VIEW_PATH . '/layout.php';
    }

    public function login(): void
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $_SESSION['error'] = 'Complete todos los campos';
            $this->redirect('/login');
        }

        $user = $this->userModel->findByEmail($email);

        if ($user && $this->userModel->verifyPassword($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['rol'];
            $_SESSION['user_name'] = $user['nombre'];
            $this->redirect('/menu');
        }

        $_SESSION['error'] = 'Credenciales incorrectas';
        $this->redirect('/login');
    }

    public function register(): void
    {
        $nombre = trim($_POST['nombre'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $rol = $_POST['rol'] ?? 'cliente';

        if (empty($nombre) || empty($email) || empty($password)) {
            $_SESSION['error'] = 'Complete todos los campos';
            $this->redirect('/register');
        }

        if ($this->userModel->findByEmail($email)) {
            $_SESSION['error'] = 'El email ya está registrado';
            $this->redirect('/register');
        }

        $this->userModel->create([
            'nombre' => $nombre,
            'email' => $email,
            'password' => $this->userModel->hashPassword($password),
            'rol' => $rol,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $_SESSION['success'] = 'Cuenta creada exitosamente';
        $this->redirect('/login');
    }

    public function logout(): void
    {
        session_destroy();
        $this->redirect('/login');
    }
}