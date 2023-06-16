<?php
include_once("./../register-val/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    //EXTRAER VALORES PARA AÑADIR PRÉSTAMO
    $idPrestamoAmortizar = intval($_POST['idAmortizar']);
    $montoAmortizar = $_POST['montoAmortizar'];
    $fechaAmortizar = $_POST['fechaAmortizar'];


    //var_dump($idPrestamoAmortizar, $montoAmortizar, $fechaAmortizar);
    //die();

    // INSERTAR LA INFORMACIÓN EN LA BASE DE DATOS
    $db = connect_db();

    $sql = "INSERT INTO pago (id, idPrestamo, cuota, fecha) 
            VALUES (null, ?, ?, ?)";

    $stmt = $db->prepare($sql);
    $stmt->bind_param("ids", $idPrestamoAmortizar,$montoAmortizar, $fechaAmortizar);
    $stmt->execute();

    // Comprueba si la inserción se ejecutó correctamente
    if ($stmt->affected_rows > 0) {
        $_SESSION['successMessage'] = "Pago de S/". strval($montoAmortizar). " realizado correctamente.";
        header("Location: ./../main.php");
        exit;
    } else {
        echo "No se agregó el préstamo".$db->error;
        exit;
    }
}
?>
