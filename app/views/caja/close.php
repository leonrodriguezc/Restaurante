<h2>Cerrar Caja</h2>
<a href="/caja" class="btn btn-outline-secondary mb-3">Volver</a>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>

<form action="/caja/close" method="POST" class="card">
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label">Monto de Cierre (Efectivo en Caja)</label>
            <input type="number" name="monto_cierre" step="0.01" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-danger">Cerrar Caja</button>
    </div>
</form>