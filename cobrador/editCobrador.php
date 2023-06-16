<?php
include_once("./../register-val/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    //EXTRAER VALORES PARA EDITAR PRÉSTAMO
    $idCobradorEdit = intval($_POST['idCobradorEdit']);
    $nombreEdit = $_POST['nombreEdit'];
    $apellidoEdit = $_POST['apellidoEdit'];
    $documentoEdit = $_POST['documentoEdit'];
    $telefonoEdit= $_POST['telefonoEdit'];

    // INSERTAR LA INFORMACIÓN EN LA BASE DE DATOS

    $db = connect_db();

    // Utilizando consultas preparadas con mysqli
    $stmt = $db->prepare("UPDATE cobrador SET nombre = ?, apellido = ?, dni = ?, telefono = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $nombreEdit, $apellidoEdit, $documentoEdit, $telefonoEdit, $idCobradorEdit);
    $stmt->execute();

    mysqli_close($db);

    // Comprueba si la consulta se ejecutó correctamente
    if ($stmt->affected_rows > 0) {
        $_SESSION['successMessage'] = "Los datos del cobrador ".$nombreEdit." ".$apellidoEdit." se actualizaron exitosamente.";
        header("Location: ./../main.php");
        exit();
    } else {
        echo "No se encontró el cobrador.";
        exit;
    }
}
?>
