<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Pedidos</h1>
    <a href="/pedidos/create" class="btn btn-success">Nuevo Pedido</a>
</div>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
<?php endif; ?>

<?php if (empty($pedidos)): ?>
    <div class="alert alert-info">No hay pedidos activos</div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidos as $p): ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td><?= htmlspecialchars($p['cliente'] ?? 'N/A') ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($p['fecha_hora'])) ?></td>
                    <td>$<?= number_format($p['total'], 2) ?></td>
                    <td><span class="badge bg-<?= $p['estado'] === 'pendiente' ? 'warning' : 'info' ?>"><?= ucfirst($p['estado']) ?></span></td>
                    <td>
                        <a href="/pedidos/edit?id=<?= $p['id'] ?>" class="btn btn-sm btn-primary">Ver</a>
                        <a href="/pedidos/close?id=<?= $p['id'] ?>" class="btn btn-sm btn-success">Cerrar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>