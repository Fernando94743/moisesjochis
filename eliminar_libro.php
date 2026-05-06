<?php
session_start();
require_once 'db.php'; // Tu archivo de conexión

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $pdo = conectarDB();
    
    // Eliminamos el libro por su ID
    // (Asegúrate de que tu columna se llame 'id' o 'id_libro' según tu tabla)
    $stmt = $pdo->prepare("DELETE FROM libros WHERE id = ?");
    $stmt->execute([$id]);
}

// Lo regresamos a la tabla automáticamente sin que se dé cuenta
header("Location: alta_libro.php");
exit();
?>
