<?php
include_once("./../db/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //EXTRAER VALORES PARA EDITAR PRÉSTAMO
    $idPrestamo = intval($_POST['idPrestamoEdit']);
    $clienteEdit = $_POST['clienteEdit'];
    $cobradorEdit = $_POST['cobradorEdit'];
    $montoEdit = intval($_POST['montoEdit']);
    $tasaEdit = intval($_POST['tasaEdit']);
    $cuotasEdit = intval($_POST['cuotasEdit']);

    // INSERTAR LA INFORMACIÓN EN LA BASE DE DATOS

    $db = connect_db();

    // Utilizando consultas preparadas con mysqli
    $stmt = $db->prepare("UPDATE prestamo SET monto = ?, tasa = ?, cuotas = ? WHERE id = ?");
    $stmt->bind_param("iiii", $montoEdit, $tasaEdit, $cuotasEdit, $idPrestamo);
    $stmt->execute();

    mysqli_close($db);

    // Comprueba si la consulta se ejecutó correctamente
    if ($stmt->affected_rows > 0) {
        echo "El préstamo se ha actualizado exitosamente.";
        header("Location: ./../prestamos.php");
    } else {
        echo "No se encontró el préstamo con el ID especificado.";
    }
}
?>