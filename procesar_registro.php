<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $pwd2 = $_POST['pwd2'];

    // 1. Validar que las contraseñas coincidan
    if ($pwd !== $pwd2) {
        echo "<script>alert('Las contraseñas no coinciden'); window.location='registro.html';</script>";
        exit();
    }

    $pdo = conectarDB();

    // 2. Verificar si el correo ya existe
    $checkEmail = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = ?");
    $checkEmail->execute([$email]);

    if ($checkEmail->rowCount() > 0) {
        echo "<script>alert('El correo ya está registrado'); window.location='registro.html';</script>";
    } else {
        // 3. Insertar nuevo usuario (aquí guardamos la contraseña tal cual por ahora)
        $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute([$nombre, $email, $pwd])) {
            // AQUI ESTA LA CORRECCION: Ahora te manda a index.php
            echo "<script>alert('Cuenta creada con éxito. Ya puedes iniciar sesión.'); window.location='index.php';</script>";
        } else {
            echo "Error al crear la cuenta.";
        }
    }
}
?>

