<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="text-center mb-4">Crear Cuenta</h2>
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
                <?php endif; ?>
                <form action="/register" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rol</label>
                        <select name="rol" class="form-select">
                            <option value="cliente">Cliente</option>
                            <option value="mesero">Mesero</option>
                            <option value="administrador">Administrador</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Registrarse</button>
                </form>
                <p class="text-center mt-3">
                    ¿Ya tienes cuenta? <a href="/login">Inicia sesión</a>
                </p>
            </div>
        </div>
    </div>
</div>