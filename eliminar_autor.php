<?php
session_start();
require_once 'db.php';

if (isset($_GET['id']) && isset($_SESSION['id_usuario'])) {
    $pdo = conectarDB();
    $id = $_GET['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM autores WHERE id_autor = ?");
        $stmt->execute([$id]);
    } catch (Exception $e) {
        // Si falla, es probable que el autor tenga libros asignados.
    }
}
header("Location: alta_autor.php");
exit();
?>
