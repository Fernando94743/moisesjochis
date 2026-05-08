<?php
session_start();

// EL CADENERO: Seguridad para que no entren si no han iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php"); // Cambia a tu archivo de login si se llama distinto
    exit();
}

// require_once 'db.php';
// AQUI VA TU LÓGICA PHP PARA GUARDAR EL AUTOR (si la tienes en el mismo archivo)
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de Autores - Jochis</title>
    <link href="./wwwroot/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./wwwroot/css/bootstrap-icons.min.css">

    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar { background-color: #1e1e2f; min-height: 100vh; width: 260px; position: fixed; }
        .sidebar h4 { color: #fff; letter-spacing: 1px; padding: 20px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 20px;}
        .sidebar a { color: #a9a9bc; text-decoration: none; padding: 12px 20px; display: block; border-radius: 8px; margin: 5px 15px; font-weight: 500; transition: all 0.3s ease; }
        .sidebar a:hover, .sidebar a.active { background-color: #3b3b54; color: #ffffff; transform: translateX(5px); }
        .main-content { margin-left: 260px; padding: 0; }
        .topbar { background-color: #ffffff; box-shadow: 0 2px 10px rgba(0,0,0,0.03); padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .card-custom { border: none; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.04); background: #fff; }
        .form-label { color: #858796; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; }
        .form-control { border-radius: 8px; border: 1px solid #e3e6f0; padding: 10px 15px; }
        .form-control:focus { box-shadow: none; border-color: #4e73df; }
        .btn-brand { background-color: #4e73df; color: white; font-weight: 600; border-radius: 8px; padding: 10px 20px; border: none; transition: 0.3s; }
        .btn-brand:hover { background-color: #2e59d9; color: white; box-shadow: 0 4px 10px rgba(78, 115, 223, 0.3); }
    </style>
</head>
<body>

    <div class="sidebar">
        <h4 class="fw-bold"><i class="bi bi-book-half text-primary me-2"></i> Jochis Lib</h4>
        <a href="alta_autor.php" class="active"><i class="bi bi-person-badge me-2"></i> Autores</a>
        <a href="alta_libro.php"><i class="bi bi-journal-plus me-2"></i> Libros</a>
        <a href="prestamos.php"><i class="bi bi-arrow-left-right me-2"></i> Préstamos</a>
    </div>

    <div class="main-content">
        <div class="topbar">
            <h5 class="mb-0 fw-bold text-dark" style="letter-spacing: -0.5px;">Panel de Autores</h5>
            <a href="logout.php" class="btn btn-outline-danger btn-sm fw-bold rounded-pill px-3">
                <i class="bi bi-box-arrow-right me-1"></i> Cerrar Sesión
            </a>
        </div>

        <div class="container-fluid px-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-custom mb-4">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-4" style="color: #4e73df;"><i class="bi bi-person-plus me-1"></i> Registrar Nuevo Autor</h6>

                            <form action="registrar_autor.php" method="POST">
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Nombre del autor</label>
                                    <input type="text" class="form-control" name="nombre_autor" placeholder="Ej: Gabriel García Márquez" required>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-brand">Guardar Autor</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
