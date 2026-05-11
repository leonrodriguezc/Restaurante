<h2>Pedido #<?= $pedido['id'] ?></h2>
<a href="/pedidos" class="btn btn-outline-secondary mb-3">Volver</a>

<div class="card">
    <div class="card-body">
        <p><strong>Fecha:</strong> <?= date('d/m/Y H:i', strtotime($pedido['fecha_hora'])) ?></p>
        <p><strong>Total:</strong> $<?= number_format($pedido['total'], 2) ?></p>
        <p><strong>Estado:</strong> <span class="badge bg-<?= $pedido['estado'] === 'pendiente' ? 'warning' : 'info' ?>"><?= ucfirst($pedido['estado']) ?></span></p>
        <hr>
        <h5>Items</h5>
        <table class="table">
            <thead><tr><th>Plato</th><th>Cant</th><th>P.Unit</th><th>Subtotal</th></tr></thead>
            <tbody>
                <?php foreach ($pedido['items'] as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['nombre']) ?></td>
                    <td><?= $item['cantidad'] ?></td>
                    <td>$<?= number_format($item['precio_unitario'], 2) ?></td>
                    <td>$<?= number_format($item['cantidad'] * $item['precio_unitario'], 2) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php if ($pedido['estado'] !== 'cerrado'): ?>
        <form action="/pedidos/update" method="POST" class="d-inline">
            <input type="hidden" name="id" value="<?= $pedido['id'] ?>">
            <select name="estado" class="form-select d-inline w-auto me-2">
                <option value="pendiente">Pendiente</option>
                <option value="en_preparacion">En Preparación</option>
                <option value="listo">Listo</option>
            </select>
            <button type="submit" class="btn btn-primary">Actualizar Estado</button>
        </form>
        <a href="/pedidos/close?id=<?= $pedido['id'] ?>" class="btn btn-success">Cerrar Pedido</a>
        <?php endif; ?>
    </div>
</div>