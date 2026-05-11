<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Reservas</h1>
    <a href="/reservas/create" class="btn btn-success">Nueva Reserva</a>
</div>

<form method="GET" class="row g-2 mb-4">
    <div class="col-auto">
        <input type="date" name="fecha" class="form-control" value="<?= $fecha ?>">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-outline-primary">Filtrar</button>
    </div>
</form>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
<?php endif; ?>

<?php if (empty($reservas)): ?>
    <div class="alert alert-info">No hay reservas para esta fecha</div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Hora</th>
                    <th>Cliente</th>
                    <th>Personas</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservas as $r): ?>
                <tr>
                    <td><?= date('H:i', strtotime($r['fecha_hora'])) ?></td>
                    <td><?= htmlspecialchars($r['cliente'] ?? 'N/A') ?></td>
                    <td><?= $r['personas'] ?></td>
                    <td><span class="badge bg-success"><?= ucfirst($r['estado']) ?></span></td>
                    <td>
                        <?php if ($r['estado'] === 'confirmada'): ?>
                        <a href="/reservas/cancel?id=<?= $r['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Cancelar?')">Cancelar</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>