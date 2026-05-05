<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pdo = conectarDB();
    $id_u = $_POST['id_usuario'];
    $id_l = $_POST['id_libro'];

    $stmt = $pdo->prepare("INSERT INTO prestamos (id_usuario, id_libro) VALUES (?, ?)");
    $stmt->execute([$id_u, $id_l]);
}
header("Location: prestamos.php");
