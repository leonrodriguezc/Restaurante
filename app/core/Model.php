<?php

namespace App\Core;

abstract class Model
{
    protected Database $db;
    protected string $table;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function all(): array
    {
        return $this->db->fetchAll("SELECT * FROM {$this->table}");
    }

    public function find(int $id): ?array
    {
        return $this->db->fetch(
            "SELECT * FROM {$this->table} WHERE id = ?",
            [$id]
        );
    }

    public function create(array $data): int
    {
        return $this->db->insert($this->table, $data);
    }

    public function update(int $id, array $data): int
    {
        return $this->db->update($this->table, $data, 'id = ?', [$id]);
    }

    public function delete(int $id): int
    {
        return $this->db->delete($this->table, 'id = ?', [$id]);
    }

    public function where(string $column, $value): array
    {
        return $this->db->fetchAll(
            "SELECT * FROM {$this->table} WHERE {$column} = ?",
            [$value]
        );
    }
}