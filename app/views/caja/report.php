<h2>Reporte del <?= date('d/m/Y', strtotime($fecha)) ?></h2>
<a href="/caja" class="btn btn-outline-secondary mb-3">Volver</a>

<div class="card mb-4">
    <div class="card-body">
        <h4>Total del Día: $<?= number_format($total, 2) ?></h4>
        <p>Pedidos cerrados: <?= count($pedidos) ?></p>
    </div>
</div>

<?php if (empty($pedidos)): ?>
    <div class="alert alert-info">No hay pedidos en esta fecha</div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Hora</th>
                    <th>Total</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidos as $p): ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td><?= date('H:i', strtotime($p['fecha_hora'])) ?></td>
                    <td>$<?= number_format($p['total'], 2) ?></td>
                    <td><span class="badge bg-success"><?= ucfirst($p['estado']) ?></span></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>