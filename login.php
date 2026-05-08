<?php
// ¡El session_start siempre debe ir hasta arriba!
session_start();
require_once 'db.php';

// Verificamos que se hayan enviado datos por el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    $db = conectarDB();

    try {
        $sql = "SELECT id_usuario, password, email FROM usuarios WHERE email = :email";
        $query = $db->prepare($sql);

        // Ejecutamos pasando el email
        $query->execute(['email'  => $email]);
        $usuario = $query->fetch(PDO::FETCH_ASSOC);

        if($usuario){
            // Comparamos la contraseña (texto plano, como la guardaste en el registro)
            if($pwd == $usuario['password']){

                // ¡CORRECCIÓN CRÍTICA! Le llamamos 'usuario' para que el Cadenero lo deje pasar
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['id_usuario'] = $usuario['id_usuario'];

                // MAGIA DE LA COOKIE (Rúbrica: Recordar correo)
                if (isset($_POST['recordar'])) { 
                    setcookie("correo_jochis", $email, time() + (86400 * 30), "/"); 
                } else {
                    setcookie("correo_jochis", "", time() - 3600, "/"); 
                }

                // Redirigimos al panel con pase VIP
                header("Location: alta_libro.php");
                exit(); 

            } else {
                // Si la contraseña está mal, lo regresamos con alerta
                echo "<script>alert('La contraseña es incorrecta.'); window.location='index.php';</script>";
            }

        } else {
            // Si el correo no existe, lo regresamos con alerta
            echo "<script>alert('No se encontró ninguna cuenta con ese correo.'); window.location='index.php';</script>";
        }

    } catch (PDOException $e) {
        echo "Database Error: " . $e->getMessage();
    }
} else {
    // Si intentan entrar a este archivo directo por la URL, los rebotamos
    header("Location: index.php");
    exit();
}
?>
