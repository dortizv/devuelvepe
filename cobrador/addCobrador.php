<?php
include_once("./../register-val/db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //EXTRAER VALORES PARA AÑADIR CLIENTE
    $idUsuario = intval($_POST['idUsuario']);
    $nombreCobradorAdd = strtoupper($_POST['nombreCobradorAdd']);
    $apellidoCobradorAdd = strtoupper($_POST['apellidoCobradorAdd']);
    $dniCobradorAdd = $_POST['dniCobradorAdd'];
    $telefonoCobradorAdd = $_POST['telefonoCobradorAdd'];

    //var_dump($idUsuario, $nombreCobradorAdd, $apellidoCobradorAdd, $dniCobradorAdd,$telefonoCobradorAdd);
    //die();

    // INSERTAR LA INFORMACIÓN EN LA BASE DE DATOS
    $db = connect_db();

    $sql = "INSERT INTO cobrador (id, idUsuario, nombre, apellido, 
                                dni, telefono) 
            VALUES (null, ?, ?, ?, ?, ?)";

    $stmt = $db->prepare($sql);
    $stmt->bind_param("issss", $idUsuario, $nombreCobradorAdd, $apellidoCobradorAdd, $dniCobradorAdd, $telefonoCobradorAdd);
    $stmt->execute();

    // Comprueba si la inserción se ejecutó correctamente
    if ($stmt->affected_rows > 0) {
        $_SESSION['success_add_cobrador'] = "El cliente".$nombreCobradorAdd." ".$apellidoCobradorAdd."se agregó correctamente.";
        header("Location: ./../prestamos.php");
    } else {
        echo "No se agregó el préstamo" . $db->error;
    }
}
?>
