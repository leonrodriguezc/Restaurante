<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Pedido;
use App\Models\Caja;
use App\Models\Plato;

class PedidoController extends Controller
{
    private Pedido $pedidoModel;
    private DetallePedido $detalleModel;
    private Caja $cajaModel;
    private Plato $platoModel;

    public function __construct()
    {
        $this->pedidoModel = new Pedido();
        $this->detalleModel = new DetallePedido();
        $this->cajaModel = new Caja();
        $this->platoModel = new Plato();
    }

    public function index(): void
    {
        $this->auth();
        $pedidos = $this->pedidoModel->getActivos();
        $title = 'Pedidos';
        $content = __DIR__ . '/../views/pedidos/index.php';
        require VIEW_PATH . '/layout.php';
    }

    public function create(): void
    {
        $this->auth();
        $platos = $this->platoModel->all();
        $title = 'Nuevo Pedido';
        $content = __DIR__ . '/../views/pedidos/create.php';
        require VIEW_PATH . '/layout.php';
    }

    public function edit(): void
    {
        $this->auth();
        $id = $_GET['id'] ?? 0;
        $pedido = $this->pedidoModel->findWithDetails($id);
        $title = 'Editar Pedido';
        $content = __DIR__ . '/../views/pedidos/edit.php';
        require VIEW_PATH . '/layout.php';
    }

    public function store(): void
    {
        $this->auth();
        $items = json_decode($_POST['items'], true) ?? [];

        $caja = $this->cajaModel->getAbierta();
        if (!$caja) {
            $cajaId = $this->cajaModel->abrirCaja(0);
        } else {
            $cajaId = $caja['id'];
        }

        $total = 0;
        foreach ($items as $item) {
            $plato = $this->platoModel->find($item['plato_id']);
            $total += $plato['precio'] * $item['cantidad'];
        }

        $pedidoId = $this->pedidoModel->create([
            'usuario_id' => $_SESSION['user_id'],
            'caja_id' => $cajaId,
            'total' => $total,
            'estado' => 'pendiente',
            'fecha_hora' => date('Y-m-d H:i:s'),
        ]);

        foreach ($items as $item) {
            $this->detalleModel->create([
                'pedido_id' => $pedidoId,
                'plato_id' => $item['plato_id'],
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $this->platoModel->find($item['plato_id'])['precio'],
            ]);
        }

        $this->cajaModel->agregarVenta($cajaId, $total);
        $_SESSION['success'] = 'Pedido creado exitosamente';
        $this->redirect('/pedidos');
    }

    public function update(): void
    {
        $this->auth();
        $id = $_POST['id'];
        $estado = $_POST['estado'] ?? 'pendiente';
        $this->pedidoModel->update($id, ['estado' => $estado]);
        $_SESSION['success'] = 'Pedido actualizado';
        $this->redirect('/pedidos');
    }

    public function close(): void
    {
        $this->auth();
        $id = $_GET['id'] ?? 0;
        $this->pedidoModel->update($id, [
            'estado' => 'cerrado',
            'fecha_cierre' => date('Y-m-d H:i:s'),
        ]);
        $_SESSION['success'] = 'Pedido cerrado';
        $this->redirect('/pedidos');
    }
}