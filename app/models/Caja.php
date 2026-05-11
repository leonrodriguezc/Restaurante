<?php

namespace App\Models;

use App\Core\Model;

class Caja extends Model
{
    protected string $table = 'cajas';

    public function getAbierta(): ?array
    {
        return $this->db->fetch(
            "SELECT * FROM {$this->table} WHERE estado = 'abierta' ORDER BY id DESC LIMIT 1"
        );
    }

    public function abrirCaja(float $montoInicial): int
    {
        $abierta = $this->getAbierta();
        if ($abierta) {
            return $abierta['id'];
        }

        return $this->create([
            'fecha_apertura' => date('Y-m-d H:i:s'),
            'monto_inicial' => $montoInicial,
            'monto_cierre' => 0,
            'total_ventas' => 0,
            'estado' => 'abierta',
        ]);
    }

    public function cerrarCaja(int $id, float $montoCierre): int
    {
        return $this->update($id, [
            'fecha_cierre' => date('Y-m-d H:i:s'),
            'monto_cierre' => $montoCierre,
            'estado' => 'cerrada',
        ]);
    }

    public function agregarVenta(int $cajaId, float $monto): void
    {
        $caja = $this->find($cajaId);
        if ($caja) {
            $this->update($cajaId, [
                'total_ventas' => $caja['total_ventas'] + $monto,
            ]);
        }
    }
}