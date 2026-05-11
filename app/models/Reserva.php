<?php

namespace App\Models;

use App\Core\Model;

class Reserva extends Model
{
    protected string $table = 'reservas';

    public function getByDate(string $fecha): array
    {
        return $this->db->fetchAll(
            "SELECT r.*, u.nombre as cliente FROM {$this->table} r
             LEFT JOIN usuarios u ON r.usuario_id = u.id
             WHERE DATE(r.fecha_hora) = ? AND r.estado = 'confirmada'
             ORDER BY r.fecha_hora",
            [$fecha]
        );
    }

    public function getByUser(int $userId): array
    {
        return $this->db->fetchAll(
            "SELECT * FROM {$this->table} WHERE usuario_id = ? ORDER BY fecha_hora DESC",
            [$userId]
        );
    }
}