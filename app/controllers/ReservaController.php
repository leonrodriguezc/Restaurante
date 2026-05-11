<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Reserva;

class ReservaController extends Controller
{
    private Reserva $reservaModel;

    public function __construct()
    {
        $this->reservaModel = new Reserva();
    }

    public function index(): void
    {
        $this->auth();
        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $reservas = $this->reservaModel->getByDate($fecha);
        $title = 'Reservas';
        $content = __DIR__ . '/../views/reservas/index.php';
        require VIEW_PATH . '/layout.php';
    }

    public function create(): void
    {
        $this->auth();
        $title = 'Nueva Reserva';
        $content = __DIR__ . '/../views/reservas/create.php';
        require VIEW_PATH . '/layout.php';
    }

    public function store(): void
    {
        $this->auth();
        $fecha = trim($_POST['fecha']);
        $hora = trim($_POST['hora']);
        $personas = (int) $_POST['personas'];

        $fechaHora = $fecha . ' ' . $hora . ':00';

        $this->reservaModel->create([
            'usuario_id' => $_SESSION['user_id'],
            'fecha_hora' => $fechaHora,
            'personas' => $personas,
            'estado' => 'confirmada',
        ]);

        $_SESSION['success'] = 'Reserva confirmada';
        $this->redirect('/reservas');
    }

    public function cancel(): void
    {
        $this->auth();
        $id = $_GET['id'] ?? 0;
        $this->reservaModel->update($id, ['estado' => 'cancelada']);
        $_SESSION['success'] = 'Reserva cancelada';
        $this->redirect('/reservas');
    }
}