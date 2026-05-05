<?php
session_start();
require_once 'db.php';
if (!isset($_SESSION['id_usuario'])) { header("Location: index.html"); exit(); }
$pdo = conectarDB();
$usuarios = $pdo->query("SELECT id_usuario, nombre FROM usuarios")->fetchAll();
$libros = $pdo->query("SELECT id_libro, titulo FROM libros")->fetchAll();
$historial = $pdo->query("SELECT u.nombre as usuario, l.titulo as libro, p.fecha_prestamo FROM prestamos p JOIN usuarios u ON p.id_usuario = u.id_usuario JOIN libros l ON p.id_libro = l.id_libro ORDER BY p.id_prestamo DESC")->fetchAll();
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Sistema Biblioteca - Préstamos</title>
    <link href="./wwwroot/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .navbar-custom { background-color: #0d6efd; color: white; padding: 10px 20px; }
        .sidebar { background-color: #f8f9fa; border-right: 1px solid #dee2e6; min-height: 100vh; }
        .nav-link { color: #0d6efd; padding: 10px; border-radius: 5px; }
        .nav-link.active { background-color: #0d6efd; color: white !important; }
    </style>
</head>
<body>
    <header class="navbar-custom d-flex justify-content-between align-items-center">
        <h5 class="m-0 fw-bold">Sistema Biblioteca</h5>
        <a href="logout.php" class="text-white text-decoration-none">Salir</a>
    </header>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 sidebar p-3">
                <div class="nav flex-column gap-2">
                    <a class="nav-link" href="alta_autor.php"><i class="bi bi-person-plus me-2"></i> Alta Autor</a>
                    <a class="nav-link" href="alta_libro.php"><i class="bi bi-book me-2"></i> Alta Libro</a>
                    <a class="nav-link active" href="prestamos.php"><i class="bi bi-arrow-left-right me-2"></i> Préstamo</a>
                </div>
            </nav>
            <main class="col-md-10 p-5">
                <h3 class="fw-bold mb-4">Registrar Préstamo</h3>
                <form action="guardar_prestamo.php" method="POST" class="col-md-6 card p-4 shadow-sm mb-5">
                    <label class="form-label fw-bold">Usuario</label>
                    <select name="id_usuario" class="form-select mb-3"><?php foreach($usuarios as $u): ?><option value="<?=$u['id_usuario']?>"><?=$u['nombre']?></option><?php endforeach; ?></select>
                    <label class="form-label fw-bold">Libro</label>
                    <select name="id_libro" class="form-select mb-3"><?php foreach($libros as $l): ?><option value="<?=$l['id_libro']?>"><?=$l['titulo']?></option><?php endforeach; ?></select>
                    <button type="submit" class="btn btn-primary fw-bold">Prestar</button>
                </form>
                <h4 class="fw-bold mb-3">Historial de préstamos</h4>
                <table class="table table-striped border">
                    <thead class="table-dark"><tr><th>Usuario</th><th>Libro</th><th>Fecha</th></tr></thead>
                    <tbody><?php foreach($historial as $h): ?><tr><td><?=$h['usuario']?></td><td><?=$h['libro']?></td><td><?=$h['fecha_prestamo']?></td></tr><?php endforeach; ?></tbody>
                </table>
            </main>
        </div>
    </div>
</body>
</html>
