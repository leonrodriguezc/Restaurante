<?php

namespace App\Models;

use App\Core\Model;

class Categoria extends Model
{
    protected string $table = 'categorias';
}

class Plato extends Model
{
    protected string $table = 'platos';

    public function findByCategoria(int $categoriaId): array
    {
        return $this->db->fetchAll(
            "SELECT * FROM {$this->table} WHERE categoria_id = ? ORDER BY nombre",
            [$categoriaId]
        );
    }

    public function buscar(string $termino): array
    {
        return $this->db->fetchAll(
            "SELECT p.*, c.nombre as categoria FROM {$this->table} p
             LEFT JOIN categorias c ON p.categoria_id = c.id
             WHERE p.nombre LIKE ? OR p.descripcion LIKE ?",
            ["%{$termino}%", "%{$termino}%"]
        );
    }
}