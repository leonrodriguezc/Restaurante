<?php

namespace App\Models;

use App\Core\Model;

class Pedido extends Model
{
    protected string $table = 'pedidos';

    public function findWithDetails(int $id): ?array
    {
        $pedido = $this->find($id);
        if ($pedido) {
            $pedido['items'] = $this->getItems($id);
        }
        return $pedido;
    }

    public function getItems(int $pedidoId): array
    {
        return $this->db->fetchAll(
            "SELECT dp.*, p.nombre, p.precio FROM detalle_pedido dp
             JOIN platos p ON dp.plato_id = p.id
             WHERE dp.pedido_id = ?",
            [$pedidoId]
        );
    }

    public function getActivos(): array
    {
        return $this->db->fetchAll(
            "SELECT pe.*, u.nombre as cliente FROM {$this->table} pe
             LEFT JOIN usuarios u ON pe.usuario_id = u.id
             WHERE pe.estado IN ('pendiente', 'en_preparacion')
             ORDER BY pe.fecha_hora DESC"
        );
    }

    public function getByDate(string $fecha): array
    {
        return $this->db->fetchAll(
            "SELECT * FROM {$this->table} WHERE DATE(fecha_hora) = ? AND estado = 'cerrado'",
            [$fecha]
        );
    }
}

class DetallePedido extends Model
{
    protected string $table = 'detalle_pedido';

    public function createPedido(array $pedidoData, array $items): int
    {
        $pedidoId = $this->db->insert('pedidos', $pedidoData);
        foreach ($items as $item) {
            $item['pedido_id'] = $pedidoId;
            $this->db->insert($this->table, $item);
        }
        return $pedidoId;
    }
}