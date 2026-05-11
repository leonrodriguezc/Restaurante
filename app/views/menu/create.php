<h2>Agregar Plato</h2>
<a href="/menu" class="btn btn-outline-secondary mb-3">Volver</a>

<form action="/menu" method="POST" class="card">
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="categoria_id" class="form-select" required>
                <option value="">Seleccionar...</option>
                <?php foreach ($categorias as $cat): ?>
                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" name="precio" step="0.01" class="form-control" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="disponible" id="disponible" class="form-check-input" checked>
            <label class="form-check-label" for="disponible">Disponible</label>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </div>
</form>