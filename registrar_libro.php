<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['id_usuario'])) {
    $pdo = conectarDB();
    
    $titulo = $_POST['titulo'];
    $isbn   = $_POST['isbn'];
    $nombre_autor = $_POST['nombre_autor']; // Recibimos el texto que escribiste

    try {
        $pdo->beginTransaction();

        // 1. Buscamos si el autor ya existe en la base de datos
        $stmt = $pdo->prepare("SELECT id_autor FROM autores WHERE nombre = ?");
        $stmt->execute([$nombre_autor]);
        $autor = $stmt->fetch();

        if ($autor) {
            $id_autor = $autor['id_autor'];
        } else {
            // Si el autor no existe, lo creamos automáticamente
            $stmt = $pdo->prepare("INSERT INTO autores (nombre) VALUES (?)");
            $stmt->execute([$nombre_autor]);
            $id_autor = $pdo->lastInsertId();
        }

        // 2. Insertamos el libro en la tabla libros
        $stmt = $pdo->prepare("INSERT INTO libros (titulo, isbn, numero_de_paginas, disponibles) VALUES (?, ?, 0, 1)");
        $stmt->execute([$titulo, $isbn]);
        $id_libro = $pdo->lastInsertId();

        // 3. Vinculamos el libro con el autor en la tabla auto_libro
        $stmt = $pdo->prepare("INSERT INTO auto_libro (id_autor, id_libro) VALUES (?, ?)");
        $stmt->execute([$id_autor, $id_libro]);

        $pdo->commit();
    } catch (Exception $e) {
        $pdo->rollBack();
    }
}

header("Location: alta_libro.php");
exit();
