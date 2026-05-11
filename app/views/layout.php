<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Restaurante Vegano' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
    <?php if (isset($_SESSION['user_id'])): ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="/">Restaurante Vegano</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/menu">Menú</a></li>
                    <li class="nav-item"><a class="nav-link" href="/pedidos">Pedidos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/reservas">Reservas</a></li>
                    <li class="nav-item"><a class="nav-link" href="/caja">Caja</a></li>
                    <li class="nav-item"><a class="nav-link" href="/logout">Salir</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <?php endif; ?>

    <main class="container py-4">
        <?php if (isset($content)): echo $content; endif; ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/app.js"></script>
</body>
</html>