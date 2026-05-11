<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Menú Digital</h1>
    <a href="/menu/create" class="btn btn-success">Agregar Plato</a>
</div>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
<?php endif; ?>

<div class="row">
    <?php foreach ($categorias as $cat): ?>
    <div class="col-12 mb-4">
        <h3 class="border-bottom pb-2"><?= htmlspecialchars($cat['nombre']) ?></h3>
        <div class="row">
            <?php foreach (array_filter($platos, fn($p) => $p['categoria_id'] == $cat['id']) as $plato): ?>
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($plato['nombre']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($plato['descripcion']) ?></p>
                        <p class="text-success fw-bold">$<?= number_format($plato['precio'], 2) ?></p>
                        <span class="badge bg-<?= $plato['disponible'] ? 'success' : 'secondary' ?>">
                            <?= $plato['disponible'] ? 'Disponible' : 'No disponible' ?>
                        </span>
                    </div>
                    <?php if ($_SESSION['user_role'] === 'administrador'): ?>
                    <div class="card-footer d-flex gap-2">
                        <a href="/menu/edit?id=<?= $plato['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                        <a href="/menu/delete?id=<?= $plato['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Eliminar</a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>