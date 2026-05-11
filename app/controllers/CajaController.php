<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Caja;
use App\Models\Pedido;

class CajaController extends Controller
{
    private Caja $cajaModel;
    private Pedido $pedidoModel;

    public function __construct()
    {
        $this->cajaModel = new Caja();
        $this->pedidoModel = new Pedido();
    }

    public function index(): void
    {
        $this->auth();
        $caja = $this->cajaModel->getAbierta();
        $title = 'Caja';
        $content = __DIR__ . '/../views/caja/index.php';
        require VIEW_PATH . '/layout.php';
    }

    public function close(): void
    {
        $this->role('administrador');
        $title = 'Cerrar Caja';
        $content = __DIR__ . '/../views/caja/close.php';
        require VIEW_PATH . '/layout.php';
    }

    public function closeDay(): void
    {
        $this->role('administrador');
        $caja = $this->cajaModel->getAbierta();

        if ($caja) {
            $montoCierre = (float) $_POST['monto_cierre'];
            $this->cajaModel->cerrarCaja($caja['id'], $montoCierre);
            $_SESSION['success'] = 'Caja cerrada exitosamente';
        } else {
            $_SESSION['error'] = 'No hay caja abierta';
        }

        $this->redirect('/caja');
    }

    public function report(): void
    {
        $this->role('administrador');
        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $pedidos = $this->pedidoModel->getByDate($fecha);

        $total = 0;
        foreach ($pedidos as $p) {
            $total += $p['total'];
        }

        $title = 'Reporte del Día';
        $data = ['fecha' => $fecha, 'pedidos' => $pedidos, 'total' => $total];
        $content = __DIR__ . '/../views/caja/report.php';
        require VIEW_PATH . '/layout.php';
    }
}