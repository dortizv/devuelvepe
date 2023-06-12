<?php
include_once("./../register-val/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    //EXTRAER VALORES PARA AÑADIR PRÉSTAMO
    $clientePrestamo = intval($_POST['clientePrestamo']);
    $cobradorPrestamo = intval($_POST['cobradorPrestamo']);
    $montoPrestamo = intval($_POST['montoPrestamo']);
    $tasaPrestamo = intval($_POST['tasaPrestamo']);
    $cuotasPrestamo = intval($_POST['cuotasPrestamo']);
    $fechaPrestamo = $_POST['fechaPrestamo'];

    //var_dump($clientePrestamo, $cobradorPrestamo, $montoPrestamo, $tasaPrestamo, $cuotasPrestamo, $fechaPrestamo);
    //die();

    // INSERTAR LA INFORMACIÓN EN LA BASE DE DATOS
    $db = connect_db();

    $sql = "INSERT INTO prestamo (id, idCobrador, idCliente, monto, 
                                tasa, cuotas, fecha) 
            VALUES (null, ?, ?, ?, ?, ?, ?)";

    $stmt = $db->prepare($sql);
    $stmt->bind_param("iiiiis", $cobradorPrestamo,$clientePrestamo, $montoPrestamo, $tasaPrestamo, $cuotasPrestamo, $fechaPrestamo);
    $stmt->execute();

    // Comprueba si la inserción se ejecutó correctamente
    if ($stmt->affected_rows > 0) {
        header("Location: ./../prestamos.php");
        exit;
    } else {
        echo "No se agregó el préstamo".$db->error;
        exit;
    }
}
?>