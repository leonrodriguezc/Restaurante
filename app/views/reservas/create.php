<h2>Nueva Reserva</h2>
<a href="/reservas" class="btn btn-outline-secondary mb-3">Volver</a>

<form action="/reservas" method="POST" class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Fecha</label>
                <input type="date" name="fecha" class="form-control" min="<?= date('Y-m-d') ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Hora</label>
                <select name="hora" class="form-select" required>
                    <option value="">Seleccionar...</option>
                    <?php for ($h = 11; $h <= 21; $h++): ?>
                    <option value="<?= str_pad($h, 2, '0', STR_PAD_LEFT) ?>:00"><?= date('h:i A', strtotime($h . ':00')) ?></option>
                    <option value="<?= str_pad($h, 2, '0', STR_PAD_LEFT) ?>:30"><?= date('h:i A', strtotime($h . ':30')) ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Número de personas</label>
            <input type="number" name="personas" min="1" max="20" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Confirmar Reserva</button>
    </div>
</form>