<?php
require_once 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $pdo = conectarDB();

    try {
        // 1. Borrar primero los préstamos asociados a este libro
        $sql1 = "DELETE FROM prestamos WHERE id_libro = ?";
        $stmt1 = $pdo->prepare($sql1);
        $stmt1->execute([$id]);

        // 2. Borrar la relación en la tabla intermedia (autor_libro)
        $sql2 = "DELETE FROM auto_libro WHERE id_libro = ?";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->execute([$id]);

        // 3. Ahora sí, el tiro de gracia: borrar el libro
        $sql3 = "DELETE FROM libros WHERE id_libro = ?";
        $stmt3 = $pdo->prepare($sql3);
        $stmt3->execute([$id]);

        // 4. Regresamos triunfantes
        header("Location: alta_libro.php?msg=eliminado");
        exit();

    } catch (PDOException $e) {
        echo "Error al eliminar: " . $e->getMessage();
    }
} else {
    echo "ID no proporcionado.";
}
?>
