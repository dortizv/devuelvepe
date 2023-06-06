<?php
    // VALIDACIÓN DE USUARIO LOGUEADO
    session_start();
    if (isset($_SESSION['nombreUsuario']) && $_SESSION['idUsuario'] ){
        
        $idPrestamo = $_POST['id_prestamo'];
        include_once("./../login-val/db.php");

        $userId = $_SESSION['idUsuario'];

        $db = connect_db();

        $sql = "SELECT prestamo.idCliente, cliente.nombre, cliente.apellido, cliente.tipodocumento, cliente.documento 
                FROM cliente 
                INNER JOIN prestamo ON prestamo.idCliente = cliente.id
                INNER JOIN cobrador ON cobrador.id = prestamo.idCobrador
                WHERE cobrador.idUsuario = ?";


        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        
        //$row = $result -> fetch_assoc();
        //var_dump($row);
        //die();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Editar préstamo</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="./assets/vendor/aos/aos.css" rel="stylesheet">
        <link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="./assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="./assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="./assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="./assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="./assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="./assets/css/style.css" rel="stylesheet">
        <link href="./assets/css/popups.css" rel="stylesheet">
        <script src="./assets/js/popup.js"></script>

    </head>
    <body style="min-width: 560px">
        <h3>Datos para editar préstamo</h3>
            <form class="col" action="register-val/lg-register.php" method = "POST">
            <div class="col-md-4 mb-3">
                <input type="text" class="form-control" name="distrito" placeholder="Distrito" value="<?php echo $idPrestamo; ?>" required>
            </div>
            <div class="col-md-4 mb-3">
                        <input type="text" class="form-control" name="distrito" placeholder="Distrito" required>
            </div>
            <div class="col-md-4 mb-3">
                        <input type="text" class="form-control" name="distrito" placeholder="Distrito" required>
            </div>
            <div class="col-md-4 mb-3">
                        <input type="text" class="form-control" name="distrito" placeholder="Distrito" required>
            </div>
            <div class="row justify-content-center pb-4">
                    <button class="mx-3" style="width: fit-content" type="submit">Guardar</button>
                    <button class="mx-3" style="background-color: lightgray; width: fit-content" type="submit" formaction="./../prestamos.php" formnovalidate>Cancelar</button>
            </div>
        </form>

        <!-- Vendor JS Files -->
        <script src="./assets/vendor/purecounter/purecounter_vanilla.js"></script>
        <script src="./assets/vendor/aos/aos.js"></script>
        <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="./assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="./assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="./assets/vendor/swiper/swiper-bundle.min.js"></script>

        <!-- Template Main JS File -->
        <script src="./assets/js/main.js"></script>

    </body>
</html>

    <?php
//FIN DE VALIDACIÓN USUARIO LOGUEADO
}else{
    header("Location:./login.php");
    exit;
}
?>