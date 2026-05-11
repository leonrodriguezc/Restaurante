<h2>Nuevo Pedido</h2>
<a href="/pedidos" class="btn btn-outline-secondary mb-3">Volver</a>

<form id="pedidoForm" class="card">
    <div class="card-body">
        <h5>Seleccionar Platos</h5>
        <div class="row mb-4">
            <?php foreach ($platos as $p): if ($p['disponible']): ?>
            <div class="col-md-4 mb-2">
                <div class="border rounded p-2">
                    <strong><?= htmlspecialchars($p['nombre']) ?></strong>
                    <br><small class="text-success">$<?= number_format($p['precio'], 2) ?></small>
                    <input type="number" min="1" value="1" class="form-control mt-2" data-plato="<?= $p['id'] ?>" data-precio="<?= $p['precio'] ?>">
                    <button type="button" class="btn btn-sm btn-outline-success w-100 mt-1" onclick="agregarPlato(<?= $p['id'] ?>, '<?= htmlspecialchars($p['nombre']) ?>', <?= $p['precio'] ?>, this.previousElementSibling.value)">+</button>
                </div>
            </div>
            <?php endif; endforeach; ?>
        </div>

        <h5>Pedido</h5>
        <table class="table" id="pedidoItems">
            <thead><tr><th>Plato</th><th>Cant</th><th>P.Unit</th><th>Subtotal</th><th></th></tr></thead>
            <tbody></tbody>
            <tfoot><tr><td colspan="3" class="text-end"><strong>Total:</strong></td><td id="pedidoTotal">$0.00</td><td></td></tr></tfoot>
        </table>
        <input type="hidden" name="items" id="itemsJson">
        <button type="submit" class="btn btn-success">Crear Pedido</button>
    </div>
</form>

<script>
let items = [];
function agregarPlato(id, nombre, precio, cantidad) {
    items.push({ plato_id: id, cantidad: parseInt(cantidad) });
    renderItems();
}
function renderItems() {
    const tbody = document.querySelector('#pedidoItems tbody');
    tbody.innerHTML = '';
    let total = 0;
    items.forEach((item, i) => {
        const sub = item.cantidad * <?= json_encode(array_column($platos, 'precio', 'id')) ?>[item.plato_id] || 0;
        total += sub;
        tbody.innerHTML += `<tr><td>${item.nombre || 'Plato #' + item.plato_id}</td><td>${item.cantidad}</td><td>$${sub.toFixed(2)}</td><td><button type="button" class="btn btn-sm btn-danger" onclick="items.splice(${i},1);renderItems()">X</button></td></tr>`;
    });
    document.getElementById('pedidoTotal').textContent = '$' + total.toFixed(2);
    document.getElementById('itemsJson').value = JSON.stringify(items);
}
document.getElementById('pedidoForm').onsubmit = e => { e.preventDefault(); if(items.length) { document.getElementById('itemsJson').value = JSON.stringify(items); fetch('/pedidos', {method:'POST', body: new URLSearchParams({items: JSON.stringify(items)})}).then(() => location.href='/pedidos'); } };
</script>