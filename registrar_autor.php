<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['id_usuario'])) {
    $pdo = conectarDB();
    $nombre = $_POST['nombre'];

    try {
        $stmt = $pdo->prepare("INSERT INTO autores (nombre) VALUES (?)");
        $stmt->execute([$nombre]);
    } catch (Exception $e) {
        // Error al guardar
    }
}
header("Location: alta_autor.php");
exit();
?>
