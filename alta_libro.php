<?php
session_start();
require_once 'db.php'; // Tu archivo de conexión a MariaDB

// Hacemos la consulta para traernos todos los libros registrados
$pdo = conectarDB();
// Asumo que tu tabla se llama 'libros' y tiene las columnas id, titulo, tomo y autor
$stmt = $pdo->prepare("DELETE FROM libros WHERE id_libro = ?"); 
$libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de Libros - Jochis</title>
    <!-- Tus links de Bootstrap -->
    <link href="./wwwroot/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./wwwroot/css/bootstrap-icons.min.css">
    
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        /* Sidebar Oscura */
        .sidebar { background-color: #1e1e2f; min-height: 100vh; width: 260px; position: fixed; }
        .sidebar h4 { color: #fff; letter-spacing: 1px; padding: 20px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 20px;}
        .sidebar a { color: #a9a9bc; text-decoration: none; padding: 12px 20px; display: block; border-radius: 8px; margin: 5px 15px; font-weight: 500; transition: all 0.3s ease; }
        .sidebar a:hover, .sidebar a.active { background-color: #3b3b54; color: #ffffff; transform: translateX(5px); }
        
        /* Contenido Principal */
        .main-content { margin-left: 260px; padding: 0; }
        .topbar { background-color: #ffffff; box-shadow: 0 2px 10px rgba(0,0,0,0.03); padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        
        /* Tarjetas */
        .card-custom { border: none; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.04); background: #fff; }
        
        /* Formularios y Botones */
        .form-label { color: #858796; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; }
        .form-control { border-radius: 8px; border: 1px solid #e3e6f0; padding: 10px 15px; }
        .form-control:focus { box-shadow: none; border-color: #4e73df; }
        .btn-brand { background-color: #4e73df; color: white; font-weight: 600; border-radius: 8px; padding: 10px 20px; border: none; transition: 0.3s; }
        .btn-brand:hover { background-color: #2e59d9; color: white; box-shadow: 0 4px 10px rgba(78, 115, 223, 0.3); }
        
        /* Tabla Limpia */
        .table th { background-color: #f8f9fa; color: #858796; font-weight: 600; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; border-bottom: none; }
        .table td { vertical-align: middle; color: #5a5c69; border-bottom: 1px solid #f1f3f5; padding: 15px 10px;}
        .table-hover tbody tr:hover { background-color: #f8f9fc; }
        
        /* Botón de Borrar */
        .btn-delete { color: #e74a3b; background-color: rgba(231, 74, 59, 0.1); border: none; border-radius: 8px; padding: 8px 12px; transition: 0.2s;}
        .btn-delete:hover { background-color: #e74a3b; color: white; transform: scale(1.05); }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4 class="fw-bold"><i class="bi bi-book-half text-primary me-2"></i> Jochis Lib</h4>
        <a href="alta_autor.php"><i class="bi bi-person-badge me-2"></i> Autores</a>
        <a href="alta_libro.php" class="active"><i class="bi bi-journal-plus me-2"></i> Libros</a>
        <a href="prestamos.php"><i class="bi bi-arrow-left-right me-2"></i> Préstamos</a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        
        <!-- TOPBAR -->
        <div class="topbar">
            <h5 class="mb-0 fw-bold text-dark" style="letter-spacing: -0.5px;">Panel de Libros</h5>
            <a href="logout.php" class="btn btn-outline-danger btn-sm fw-bold rounded-pill px-3">
                <i class="bi bi-box-arrow-right me-1"></i> Cerrar Sesión
            </a>
        </div>

        <!-- CONTENEDOR CENTRAL -->
        <div class="container-fluid px-4">
            
            <!-- TARJETA DEL FORMULARIO PARA GUARDAR -->
            <div class="card card-custom mb-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-4" style="color: #4e73df;"><i class="bi bi-plus-circle me-1"></i> Registrar Nuevo Libro</h6>
                    
                    <form action="guardar_libro.php" method="POST" class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Título</label>
                            <input type="text" class="form-control" name="titulo" placeholder="Ej. El Principito" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-bold">Número de Tomo</label>
                            <input type="number" class="form-control" name="tomo" placeholder="Ej. 1" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Autor</label>
                            <input type="text" class="form-control" name="autor" placeholder="Nombre del autor" required>
                        </div>
                        <div class="col-md-2 d-grid">
                            <button type="submit" class="btn btn-brand">Guardar Libro</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- TARJETA DE LA TABLA DINÁMICA -->
            <div class="card card-custom">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">ID</th>
                                    <th>Título del Libro</th>
                                    <th>Tomo</th>
                                    <th>Autor</th>
                                    <th class="text-center pe-4">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($libros) > 0): ?>
                                    <!-- Aquí PHP escupe los libros uno por uno -->
                                    <?php foreach ($libros as $libro): ?>
                                        <tr>
                                            <td class="ps-4 fw-bold"><?php echo htmlspecialchars($libro['id']); ?></td>
                                            <td class="fw-bold text-dark"><?php echo htmlspecialchars($libro['titulo']); ?></td>
                                            <td><span class="badge bg-secondary rounded-pill">Vol. <?php echo htmlspecialchars($libro['tomo']); ?></span></td>
                                            <td><?php echo htmlspecialchars($libro['autor']); ?></td>
                                            <td class="text-center pe-4">
                                                <!-- Mandamos el ID por GET a eliminar_libro.php con confirmación -->
                                                <a href="eliminar_libro.php?id=<?php echo $libro['id']; ?>" class="btn btn-delete shadow-sm" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este libro?');">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <!-- Mensaje si la base de datos está vacía -->
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                            No hay libros registrados aún. ¡Agrega el primero!
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

</body>
</html>
