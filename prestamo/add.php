<?php
include_once("./../register-val/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //EXTRAER VALORES PARA AÑADIR PRÉSTAMO
    $clientePrestamo = intval($_POST['clientePrestamo']);
    $cobradorPrestamo = intval($_POST['cobradorPrestamo']);
    $montoPrestamo = intval($_POST['montoPrestamo']);
    $tasaPrestamo = intval($_POST['tasaPrestamo']);
    $cuotasPrestamo = intval($_POST['cuotasPrestamo']);
    $fechaPrestamo = DateTime::createFromFormat('Y-m-d', $_POST['fechaPrestamo'])->format('Y-m-d');

    // INSERTAR LA INFORMACIÓN EN LA BASE DE DATOS

    //var_dump($clientePrestamo, $cobradorPrestamo, $montoPrestamo, $tasaPrestamo, $cuotasPrestamo, $fechaPrestamo);
    //die();

    $db = connect_db();

    $sql = "INSERT INTO prestamo (id, idCobrador, idCliente, monto, 
                                tasa, cuotas, fecha) 
            VALUES (null, ?, ?, ?, ?, ?, ?)";

    $stmt = $db->prepare($sql);
    $stmt->bind_param("iiiiis", $clientePrestamo, $cobradorPrestamo, $montoPrestamo, $tasaPrestamo, $cuotasPrestamo, $fechaPrestamo);
    $stmt->execute();

    // Comprueba si la consulta se ejecutó correctamente
    if ($stmt->affected_rows > 0) {
        echo "El préstamo se agregó.";
        header("Location: ./../prestamos.php");
    } else {
        echo "No se agregó el préstamo".$db->error;
    }
}
?>