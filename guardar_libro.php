<?php
session_start();
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibimos los datos del formulario
    $titulo = $_POST['titulo'];
    $tomo = $_POST['tomo'];
    $autor = $_POST['autor'];

    $pdo = conectarDB();

    // MAGIA 1: Evitar duplicados lógicos
    // Buscamos si ya hay un libro con ese mismo título y tomo
    $stmt_check = $pdo->prepare("SELECT * FROM libros WHERE titulo = ? AND tomo = ?");
    $stmt_check->execute([$titulo, $tomo]);

    if ($stmt_check->rowCount() > 0) {
        // Si el libro ya existe, mandamos una alerta y lo rebotamos
        echo "<script>
                alert('¡Tranquilo! Ese libro (Tomo $tomo) ya está registrado en el sistema.'); 
                window.location='alta_libro.php';
              </script>";
        exit();
    } else {
        // Si no existe, lo insertamos normal
        // (Ajusta los nombres de las columnas si en tu BD se llaman distinto)
        $stmt_insert = $pdo->prepare("INSERT INTO libros (titulo, tomo, autor) VALUES (?, ?, ?)");
        $stmt_insert->execute([$titulo, $tomo, $autor]);

        // MAGIA 2: El truco anti-F5
        // En lugar de mostrar un mensaje aquí, lo redirigimos directo a la tabla.
        // Así, si presiona F5, solo recargará la tabla y no el formulario de guardado.
        header("Location: alta_libro.php");
        exit();
    }
}
?>

