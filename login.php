<?php
// 1. ¡El session_start siempre debe ir hasta arriba!
session_start();
require_once 'db.php';

// 2. Verificamos que los datos vengan por POST (desde el formulario)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    $db = conectarDB();

    try {
        // Buscamos al usuario por su email
        $sql = "SELECT id_usuario, password, email FROM usuarios WHERE email = :email";
        $query = $db->prepare($sql);
        $query->execute(['email' => $email]);
        $usuario = $query->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            // 3. Comparamos la contraseña (texto plano como lo tienes en tu registro)
            if ($pwd == $usuario['password']) {

                // --- INICIO DE SESIÓN EXITOSO ---

                // A. Creamos las variables de sesión
                $_SESSION['usuario'] = $usuario['email']; // El gafete para que el "cadenero" te deje pasar
                $_SESSION['id_usuario'] = $usuario['id_usuario'];

                // B. LÓGICA DE LAS IMÁGENES (Cookie de Auto-Login)
                // Esto guarda tu ID en el navegador por 30 días
                $cookie_name = "id_usuario";
                $cookie_value = $usuario['id_usuario'];
                $expiry = time() + (86400 * 30); // 30 días en segundos
                setcookie($cookie_name, $cookie_value, $expiry, "/");

                // C. COOKIE DE "RECORDAR CORREO" (Para el checkbox de tu diseño)
                if (isset($_POST['recordar'])) {
                    setcookie("correo_jochis", $email, time() + (86400 * 30), "/");
                } else {
                    // Si no marcó la casilla, borramos la cookie de correo por si existía
                    setcookie("correo_jochis", "", time() - 3600, "/");
                }

                // D. Redirigimos al panel de libros
                header("Location: alta_libro.php");
                exit();

            } else {
                // Contraseña incorrecta
                echo "<script>alert('La contraseña es incorrecta.'); window.location='index.php';</script>";
            }

        } else {
            // Usuario no encontrado
            echo "<script>alert('No se encontró ninguna cuenta con ese correo.'); window.location='index.php';</script>";
        }

    } catch (PDOException $e) {
        echo "Database Error: " . $e->getMessage();
    }
} else {
    // Si alguien intenta entrar a este archivo directo por la URL, lo mandamos al login
    header("Location: index.php");
    exit();
}
?>
