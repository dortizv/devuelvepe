<?php
include_once("./../register-val/db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //EXTRAER VALORES PARA AÑADIR CLIENTE
    $nombreAdd = strtoupper($_POST['nombreAdd']);
    $apellidoAdd = strtoupper($_POST['apellidoAdd']);
    $documentoAdd = $_POST['documentoAdd'];
    $tipodocumentoAdd = $_POST['tipodocumentoAdd'];
    $direccionAdd = $_POST['direccionAdd'];
    $telefonoAdd = $_POST['telefonoAdd'];

    //var_dump($nombreAdd, $apellidoAdd, $documentoAdd,$tipodocumentoAdd,$direccionAdd, $telefonoAdd);
    //die();

    // INSERTAR LA INFORMACIÓN EN LA BASE DE DATOS
    $db = connect_db();

    $sql = "INSERT INTO cliente (id, nombre, apellido, tipodocumento, 
                                documento, direccion, telefono) 
            VALUES (null, ?, ?, ?, ?, ?, ?)";

    $stmt = $db->prepare($sql);
    $stmt->bind_param("ssssss", $nombreAdd, $apellidoAdd, $tipodocumentoAdd, $documentoAdd, $direccionAdd, $telefonoAdd);
    $stmt->execute();

    // Comprueba si la inserción se ejecutó correctamente
    if ($stmt->affected_rows > 0) {
        $_SESSION['success_add_client'] = "El cliente".$nombreAdd." ".$apellidoAdd."se agregó correctamente.";
        header("Location: ./../clientes.php");
    } else {
        echo "No se agregó el préstamo" . $db->error;
    }
}
?>