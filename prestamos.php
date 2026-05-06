<?php
session_start();
// require_once 'db.php'; 
// AQUI VA TU LÓGICA PHP PARA LLENAR LOS SELECTS Y LA TABLA
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de Préstamos - Jochis</title>
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
        .form-select, .form-control { border-radius: 8px; border: 1px solid #e3e6f0; padding: 10px 15px; }
        .form-select:focus, .form-control:focus { box-shadow: none; border-color: #4e73df; }
        .btn-brand { background-color: #4e73df; color: white; font-weight: 600; border-radius: 8px; padding: 10px 20px; border: none; transition: 0.3s; }
        .btn-brand:hover { background-color: #2e59d9; color: white; box-shadow: 0 4px 10px rgba(78, 115, 223, 0.3); }
        
        /* Estilos de Tabla */
        .table th { background-color: #f8f9fa; color: #858796; font-weight: 600; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; border-bottom: none; }
        .table td { vertical-align: middle; color: #5a5c69; border-bottom: 1px solid #f1f3f5; padding: 15px 10px;}
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4 class="fw-bold"><i class="bi bi-book-half text-primary me-2"></i> Jochis Lib</h4>
        <a href="alta_autor.php"><i class="bi bi-person-badge me-2"></i> Autores</a>
        <a href="alta_libro.php"><i class="bi bi-journal-plus me-2"></i> Libros</a>
        <a href="prestamos.php" class="active"><i class="bi bi-arrow-left-right me-2"></i> Préstamos</a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="topbar">
            <h5 class="mb-0 fw-bold text-dark" style="letter-spacing: -0.5px;">Control de Préstamos</h5>
            <a href="logout.php" class="btn btn-outline-danger btn-sm fw-bold rounded-pill px-3">
                <i class="bi bi-box-arrow-right me-1"></i> Cerrar Sesión
            </a>
        </div>

        <div class="container-fluid px-4">
            
            <!-- TARJETA DEL FORMULARIO -->
            <div class="card card-custom mb-5">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-4" style="color: #4e73df;"><i class="bi bi-bookmark-check me-1"></i> Registrar Préstamo</h6>
                    
                    <form action="guardar_prestamo.php" method="POST" class="row g-3 align-items-end">
                        <div class="col-md-5">
                            <label class="form-label fw-bold">Usuario</label>
                            <select class="form-select" name="usuario" required>
                                <option value="" selected disabled>Selecciona un usuario...</option>
                                <!-- AQUI VA TU PHP PARA LLENAR LOS USUARIOS -->
                                <option value="1">Jochis</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-bold">Libro</label>
                            <select class="form-select" name="libro" required>
                                <option value="" selected disabled>Selecciona un libro...</option>
                                <!-- AQUI VA TU PHP PARA LLENAR LOS LIBROS -->
                                <option value="1">La niña del aro</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-grid">
                            <button type="submit" class="btn btn-brand">Prestar</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- TARJETA DEL HISTORIAL (TABLA) -->
            <h6 class="fw-bold text-secondary mb-3"><i class="bi bi-clock-history me-1"></i> Historial de préstamos</h6>
            <div class="card card-custom">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Usuario</th>
                                    <th>Libro</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- AQUI VA TU CICLO PHP PARA LLENAR LA TABLA DE PRÉSTAMOS -->
                                <tr>
                                    <td class="ps-4 fw-bold text-dark">Jochis</td>
                                    <td>La niña del aro</td>
                                    <td><span class="badge bg-light text-dark border">2026-04-25 07:55:31</span></td>
                                </tr>
                                <tr>
                                    <td class="ps-4 fw-bold text-dark">Juan Reynoso Elias</td>
                                    <td>Postgresql</td>
                                    <td><span class="badge bg-light text-dark border">2026-04-24 21:45:39</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</body>
</html>
