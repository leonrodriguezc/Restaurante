<?php

return [
    'GET' => [
        '/' => ['Auth', 'index'],
        '/login' => ['Auth', 'loginForm'],
        '/register' => ['Auth', 'registerForm'],
        '/logout' => ['Auth', 'logout'],
        '/menu' => ['Menu', 'index'],
        '/menu/create' => ['Menu', 'create'],
        '/menu/edit' => ['Menu', 'edit'],
        '/menu/delete' => ['Menu', 'delete'],
        '/pedidos' => ['Pedido', 'index'],
        '/pedidos/create' => ['Pedido', 'create'],
        '/pedidos/edit' => ['Pedido', 'edit'],
        '/pedidos/close' => ['Pedido', 'close'],
        '/reservas' => ['Reserva', 'index'],
        '/reservas/create' => ['Reserva', 'create'],
        '/reservas/cancel' => ['Reserva', 'cancel'],
        '/caja' => ['Caja', 'index'],
        '/caja/close' => ['Caja', 'close'],
        '/caja/report' => ['Caja', 'report'],
    ],
    'POST' => [
        '/login' => ['Auth', 'login'],
        '/register' => ['Auth', 'register'],
        '/menu' => ['Menu', 'store'],
        '/menu/update' => ['Menu', 'update'],
        '/pedidos' => ['Pedido', 'store'],
        '/pedidos/update' => ['Pedido', 'update'],
        '/reservas' => ['Reserva', 'store'],
        '/caja/close' => ['Caja', 'closeDay'],
    ],
];