<?php if (isset($caja)): ?>
<div class="card mb-4">
    <div class="card-body">
        <h5>Caja Abierta</h5>
        <p><strong>Inicio:</strong> <?= date('d/m/Y H:i', strtotime($caja['fecha_apertura'])) ?></p>
        <p><strong>Monto Inicial:</strong> $<?= number_format($caja['monto_inicial'], 2) ?></p>
        <p><strong>Total Ventas:</strong> $<?= number_format($caja['total_ventas'], 2) ?></p>
        <p><strong>Efectivo Esperado:</strong> $<?= number_format($caja['monto_inicial'] + $caja['total_ventas'], 2) ?></p>
    </div>
</div>
<?php else: ?>
<div class="alert alert-warning">La caja está cerrada</div>
<a href="/caja/close" class="btn btn-primary">Abrir Caja</a>
<?php endif; ?>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5>Cierre de Caja</h5>
                <a href="/caja/close" class="btn btn-success w-100">Cerrar Día</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5>Reportes</h5>
                <form action="/caja/report" method="GET" class="d-flex gap-2">
                    <input type="date" name="fecha" class="form-control" value="<?= date('Y-m-d') ?>">
                    <button type="submit" class="btn btn-outline-primary">Ver Reporte</button>
                </form>
            </div>
        </div>
    </div>
</div>