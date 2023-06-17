<?php
include_once("./../db/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    //EXTRAER VALORES PARA EDITAR PRÉSTAMO
    $idClienteEdit = intval($_POST['idClienteEdit']);
    $nombreEdit = $_POST['nombreEdit'];
    $apellidoEdit = $_POST['apellidoEdit'];
    $documentoEdit = $_POST['documentoEdit'];
    $tipodocumentoEdit = $_POST['tipodocumentoEdit'];
    $direccionEdit = $_POST['direccionEdit'];
    $telefonoEdit= $_POST['telefonoEdit'];

    // INSERTAR LA INFORMACIÓN EN LA BASE DE DATOS

    $db = connect_db();

    // Utilizando consultas preparadas con mysqli
    $stmt = $db->prepare("UPDATE cliente SET nombre = ?, apellido = ?, tipodocumento = ?, documento = ?, direccion = ?, telefono = ? WHERE id = ?");
    $stmt->bind_param("ssssssi", $nombreEdit, $apellidoEdit, $tipodocumentoEdit, $documentoEdit, $direccionEdit, $telefonoEdit,$idClienteEdit);
    $stmt->execute();

    mysqli_close($db);

    // Comprueba si la consulta se ejecutó correctamente
    if ($stmt->affected_rows > 0) {
        $_SESSION['successMessage'] = "Los datos del cliente ".$nombreEdit." ".$apellidoEdit." se actualizaron correctamente.";
        header("Location: ./../main.php");
        exit();
    } else {
        echo "No se encontró el cliente.";
        exit;
    }
}
?>
