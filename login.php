<?php

// index.php
require_once 'db.php'; // Traemos el código del otro archivo



//  Obtenemos los datos del formulario
     $email  = $_POST['email'];
     $pwd = $_POST['pwd'];
     
     // Llamamos a la función y guardamos el objeto en $db
     $db = conectarDB();
      

  try {
  


        $sql = "select id_usuario,password,email from usuarios where email= :email";
        $query = $db->prepare($sql);

	

        // Ejecutamos pasando los datos en un array
        $resultado = $query->execute([
            'email'  => $email
        ]);
        $usuario = $query->fetch(PDO::FETCH_ASSOC);
        if($usuario){
        $verify = password_verify($pwd, $usuario['password']);
        if($verify){
            session_start();
            $_SESSION['username'] = $usuario['email']; // Store session data
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
        header("Location: alta_libro.php");           
        }else{
            echo "La contraseña esta mal...";
        }
        
        
        }else{
            echo "No se encontraron datos!";
        }

        

        

        

    } catch (PDOException $e) {
        // Manejo de errores (ej. si el email ya existe y es único)
        echo "Database Error: " . $e->getMessage();

        
     
    }






?>
<?php
// ¡El session_start siempre debe ir hasta arriba!
session_start();

require_once 'db.php'; 

// Obtenemos los datos del formulario
$email = $_POST['email'];
$pwd = $_POST['pwd'];

$db = conectarDB();

try {
    $sql = "SELECT id_usuario, password, email FROM usuarios WHERE email = :email";
    $query = $db->prepare($sql);

    // Ejecutamos pasando el email
    $query->execute([
        'email'  => $email
    ]);
    
    $usuario = $query->fetch(PDO::FETCH_ASSOC);
    
    if($usuario){
        // Comparamos la contraseña directamente (texto plano)
        if($pwd == $usuario['password']){
            
            $_SESSION['username'] = $usuario['email']; 
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            header("Location: alta_libro.php");
            exit(); // Siempre pon exit() después de un header

        } else {
            echo "La contraseña está mal...";
        }

    } else {
        echo "No se encontraron datos!";
    }

} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage();
}
?>
