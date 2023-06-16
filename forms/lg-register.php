<?php
include_once("db.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    session_start();
    //EXTRAER VALORES DEL REGISTER
    $name=strtoupper($_POST['nombre']);
    $lastname=strtoupper($_POST['apellido']);
    $gender=$_POST['genero'];
    $doctype=$_POST['tipodocumento'];
    $docnumber=$_POST['numerodocumento'];
    $dist=strtoupper($_POST['distrito']);
    $prov=strtoupper($_POST['provincia']);
    $dpto=strtoupper($_POST['departamento']);
    $address=strtoupper($_POST['direccion']);
    $tlfn=$_POST['telefono'];
    $email=strtoupper($_POST['email']);
    $username=$_POST['username'];
    $pass = $_POST["pass"];

     //CIFRAR CONTRASEÑA
     $pass_segura = password_hash($pass, PASSWORD_BCRYPT, ['cost' => 4]);

    // INSERTAR LA INFORMACIÓN EN LA BASE DE DATOS
    // 1.- Conectarme a la BD ($db)
    // 2.- Crear la sentencia sql($sql)
    // 3.- Validar datos y almacenarlos
    $db = connect_db();
    $sql = "INSERT INTO usuario (id, nombre, apellido, genero, 
                                tipodocumento, documento, distrito, provincia, 
                                departamento, direccion, email, telefono, 
                                username, pass) 
            VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
    )";

    $stmt = $db->prepare($sql);
    $stmt->bind_param("sssssssssssss",$name, $lastname, $gender, $doctype, $docnumber, $dist, $prov, $dpto, $address, $email, $tlfn, $username, $pass_segura);
    $stmt->execute();
    
    // VERIFICAR SI LA INSERCIÓN FUE EXITOSA
    if($stmt->affected_rows > 0){
        // Registro exitoso
        $_SESSION['error_message'] = "Tu usuario ".$username." fue registrado correctamente.";
        header("Location:./login.php");
    }else{
        // Ocurrió un error al insertar los datos
        echo "Error en el registro: " . $db->error;
    }

    $db->close();
}
?>



