<?php
session_start();
require_once 'db.php';
if (!isset($_SESSION['id_usuario'])) { header("Location: index.html"); exit(); }
$pdo = conectarDB();
$libros = $pdo->query("SELECT l.id_libro, l.titulo, l.isbn, a.nombre AS autor_nombre FROM libros l LEFT JOIN auto_libro al ON l.id_libro = al.id_libro LEFT JOIN autores a ON al.id_autor = a.id_autor ORDER BY l.id_libro DESC")->fetchAll();
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Sistema Biblioteca - Alta Libro</title>
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
                    <a class="nav-link active" href="alta_libro.php"><i class="bi bi-book me-2"></i> Alta Libro</a>
                    <a class="nav-link" href="prestamos.php"><i class="bi bi-arrow-left-right me-2"></i> Préstamo</a>
                </div>
            </nav>
            <main class="col-md-10 p-5">
                <h3 class="fw-bold mb-4">Alta de Libros</h3>
                <div class="card p-4 shadow-sm mb-4">
                    <form action="registrar_libro.php" method="POST" class="row g-3">
                        <div class="col-md-4"><label class="form-label fw-bold">Título</label><input type="text" name="titulo" class="form-control" required></div>
                        <div class="col-md-3"><label class="form-label fw-bold">Número de Tomo</label><input type="text" name="isbn" class="form-control" required></div>
                        <div class="col-md-3"><label class="form-label fw-bold">Autor</label><input type="text" name="nombre_autor" class="form-control" required></div>
                        <div class="col-md-2 d-flex align-items-end"><button type="submit" class="btn btn-primary w-100 fw-bold">Guardar Libro</button></div>
                    </form>
                </div>
                <table class="table table-hover border">
                    <thead class="table-light"><tr><th>ID</th><th>Título</th><th>Tomo</th><th>Autor</th><th>Acciones</th></tr></thead>
                    <tbody>
                        <?php foreach($libros as $l): ?>
                        <tr><td><?=$l['id_libro']?></td><td><?=$l['titulo']?></td><td><?=$l['isbn']?></td><td><?=$l['autor_nombre']?></td><td><a href="eliminar_libro.php?id=<?=$l['id_libro']?>" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></a></td></tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </main>
        </div>
    </div>
</body>
</html>
