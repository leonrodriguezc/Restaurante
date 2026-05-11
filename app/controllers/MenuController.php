<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Categoria;
use App\Models\Plato;

class MenuController extends Controller
{
    private Categoria $categoriaModel;
    private Plato $platoModel;

    public function __construct()
    {
        $this->categoriaModel = new Categoria();
        $this->platoModel = new Plato();
    }

    public function index(): void
    {
        $this->auth();
        $categorias = $this->categoriaModel->all();
        $platos = $this->platoModel->all();
        $title = 'Menú Digital';
        $content = __DIR__ . '/../views/menu/index.php';
        require VIEW_PATH . '/layout.php';
    }

    public function create(): void
    {
        $this->role('administrador');
        $categorias = $this->categoriaModel->all();
        $title = 'Agregar Plato';
        $content = __DIR__ . '/../views/menu/create.php';
        require VIEW_PATH . '/layout.php';
    }

    public function edit(): void
    {
        $this->role('administrador');
        $id = $_GET['id'] ?? 0;
        $plato = $this->platoModel->find($id);
        $categorias = $this->categoriaModel->all();
        $title = 'Editar Plato';
        $content = __DIR__ . '/../views/menu/edit.php';
        require VIEW_PATH . '/layout.php';
    }

    public function store(): void
    {
        $this->role('administrador');
        $this->platoModel->create([
            'categoria_id' => $_POST['categoria_id'],
            'nombre' => trim($_POST['nombre']),
            'descripcion' => trim($_POST['descripcion']),
            'precio' => (float) $_POST['precio'],
            'disponible' => isset($_POST['disponible']) ? 1 : 0,
        ]);
        $_SESSION['success'] = 'Plato agregado exitosamente';
        $this->redirect('/menu');
    }

    public function update(): void
    {
        $this->role('administrador');
        $id = $_POST['id'];
        $this->platoModel->update($id, [
            'categoria_id' => $_POST['categoria_id'],
            'nombre' => trim($_POST['nombre']),
            'descripcion' => trim($_POST['descripcion']),
            'precio' => (float) $_POST['precio'],
            'disponible' => isset($_POST['disponible']) ? 1 : 0,
        ]);
        $_SESSION['success'] = 'Plato actualizado';
        $this->redirect('/menu');
    }

    public function delete(): void
    {
        $this->role('administrador');
        $id = $_GET['id'] ?? 0;
        $this->platoModel->delete($id);
        $_SESSION['success'] = 'Plato eliminado';
        $this->redirect('/menu');
    }
}