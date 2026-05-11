<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected string $table = 'usuarios';

    public function findByEmail(string $email): ?array
    {
        return $this->db->fetch(
            "SELECT * FROM {$this->table} WHERE email = ?",
            [$email]
        );
    }

    public function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}