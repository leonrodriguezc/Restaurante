<h2>Editar Plato</h2>
<a href="/menu" class="btn btn-outline-secondary mb-3">Volver</a>

<form action="/menu/update" method="POST" class="card">
    <div class="card-body">
        <input type="hidden" name="id" value="<?= $plato['id'] ?>">
        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="categoria_id" class="form-select" required>
                <?php foreach ($categorias as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $plato['categoria_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['nombre']) ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($plato['nombre']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3"><?= htmlspecialchars($plato['descripcion']) ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" name="precio" step="0.01" class="form-control" value="<?= $plato['precio'] ?>" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="disponible" id="disponible" class="form-check-input" <?= $plato['disponible'] ? 'checked' : '' ?>>
            <label class="form-check-label" for="disponible">Disponible</label>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
    </div>
</form>