<?php
session_start();

// 1. Destruimos las variables de sesión del servidor
session_unset();
session_destroy();

// 2. DESTRUIMOS LA COOKIE DE AUTO-LOGIN (La pieza clave)
// Para borrar una cookie, le ponemos una fecha de expiración en el pasado (hace una hora: time() - 3600)
if (isset($_COOKIE['id_usuario'])) {
    setcookie("id_usuario", "", time() - 3600, "/");
}

// Nota: NO destruimos la cookie de 'correo_jochis' aquí, para que la casilla 
// de "Recordar mi correo" siga funcionando cuando vuelvas a entrar.

// 3. Te mandamos de regreso a la pantalla visual correcta
header("Location: index.php");
exit();
?>
