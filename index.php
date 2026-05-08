<?php
session_start();

// --- LÓGICA DE AUTO-LOGIN (Imagen 2 del Profe) ---
// ¿Existe una cookie llamada id_usuario?
if(isset($_COOKIE["id_usuario"])) {
    /* A la variable de sesión llamada id_usuario le asignamos el valor 
       que tiene la cookie llamada id_usuario */
    $_SESSION['id_usuario'] = $_COOKIE["id_usuario"];
    
    // Le damos este valor a 'usuario' para que tu Cadenero lo deje pasar al panel
    $_SESSION['usuario'] = "usuario_reconocido_por_cookie";

    // Finalmente direccionamos al usuario a la página dashboard (alta_libro.php)
    header("Location: alta_libro.php");
    exit();
}

// --- LÓGICA DE RECORDAR CORREO (Checkbox) ---
// Leemos la cookie si existe
$email_guardado = isset($_COOKIE['correo_jochis']) ? $_COOKIE['correo_jochis'] : '';
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión - Librería</title>
    <link href="./wwwroot/css/bootstrap.min.css" rel="stylesheet">
    <link href="./wwwroot/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="./wwwroot/css/bootstrap-icons.min.css">
</head>
<body class="login-page">
    <main id="main">
        <div class="container d-flex flex-column min-vh-100 justify-content-center">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="card login-card shadow-lg p-5 rounded-3 border-0">
                        <div class="w-100 text-center mb-4">
                            <i class="bi bi-book-half" style="font-size: 3rem; color: #0d6efd;"></i>
                            <h1 class="display-6 mt-2">Iniciar sesión</h1>
                            <p class="text-muted">Use sus credenciales para iniciar sesión</p>
                        </div>

                        <form action="login.php" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="nombre@ejemplo.com" value="<?php echo htmlspecialchars($email_guardado); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="pwd" class="form-label fw-bold">Contraseña</label>
                                <input class="form-control" type="password" id="pwd" name="pwd" placeholder="••••••••" required>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="recordar" name="recordar" <?php if($email_guardado != '') echo 'checked'; ?>>
                                <label class="form-check-label text-muted" for="recordar">Recordar mi correo electrónico</label>
                            </div>

                            <div class="d-grid gap-2 py-3">
                                <button type="submit" class="btn btn-primary fw-bold py-2">Ingresar al Sistema</button>
                            </div>

                            <div class="text-center">
                               <span class="small text-muted">¿No tienes cuenta?</span>
                                <a class="small fw-bold text-decoration-none" href="registro.html"> Crear cuenta</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
