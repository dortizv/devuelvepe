<?php
//Conexión a la base de datos
include_once("db.php");

$db = connect_db();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    //Inicio de sesión
    session_start();
    

    //Extraer valores del Login
    $username=$_POST['username'];
    $pass = $_POST["pass"];

    // Consultar la tabla "usuario" para verificar credenciales
    $sql = "SELECT * FROM usuario WHERE username = ?";
    
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['pass'];

        // Verificar la contraseña encriptada
        if (password_verify($pass, $hashedPassword)) {
            
            // Inicio de sesión exitoso
            $_SESSION['nombreUsuario'] = ucwords(strtolower($row['nombre']));
            $_SESSION['idUsuario'] = $row['id'];
            header('Location:./../main.php');
            //echo "Inicio de sesión exitoso. Bienvenido: ".$nombreUsuario ;
            
            // Fallo en Inicio de sesión
        } else {
            
            // Credenciales inválidas
            $_SESSION['error_message'] = "Credenciales inválidas. Por favor, intente nuevamente.";
            header("Location: ../prueba.php");
            exit;
            
        }
    } else {
        
        // Credenciales inválidas
        $_SESSION['error_message'] = "Credenciales inválidas. Por favor, intente nuevamente.";
        header("Location: ../prueba.php");
        exit;
    }

    $stmt->close();
    $db->close();
}
?>