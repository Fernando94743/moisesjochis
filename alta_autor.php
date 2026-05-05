<?php
session_start();
require_once 'db.php';
if (!isset($_SESSION['id_usuario'])) { header("Location: index.html"); exit(); }
$pdo = conectarDB();
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Sistema Biblioteca - Alta Autor</title>
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
                    <a class="nav-link active" href="alta_autor.php"><i class="bi bi-person-plus me-2"></i> Alta Autor</a>
                    <a class="nav-link" href="alta_libro.php"><i class="bi bi-book me-2"></i> Alta Libro</a>
                    <a class="nav-link" href="prestamos.php"><i class="bi bi-arrow-left-right me-2"></i> Préstamo</a>
                </div>
            </nav>
            <main class="col-md-10 p-5">
                <h3 class="fw-bold mb-4">Alta de Autor</h3>
                <form action="registrar_autor.php" method="POST" class="col-md-6 card p-4 shadow-sm">
                    <label class="form-label fw-bold">Nombre del autor</label>
                    <input type="text" name="nombre" class="form-control mb-3" placeholder="Ej: Gabriel García Márquez" required>
                    <button type="submit" class="btn btn-primary fw-bold">Guardar</button>
                </form>
            </main>
        </div>
    </div>
</body>
</html>
