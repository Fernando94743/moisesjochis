<?php
// Leemos la cookie si existe
$email_guardado = isset($_COOKIE['usuario_email']) ? $_COOKIE['usuario_email'] : '';
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
                                <!-- Se inyecta la variable de la cookie en el atributo value -->
                                <input type="email" class="form-control" id="email" name="email" placeholder="nombre@ejemplo.com" value="<?php echo htmlspecialchars($email_guardado); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="pwd" class="form-label fw-bold">Contraseña</label>
                                <input class="form-control" type="password" id="pwd" name="pwd" placeholder="••••••••" required>
                            </div>

                            <!-- NUEVO: Checkbox de la cookie para guardar el correo -->
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="recuerdame" name="recuerdame" <?php if($email_guardado != '') echo 'checked'; ?>>
                                <label class="form-check-label text-muted" for="recuerdame">Recordar mi correo electrónico</label>
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
