<?php
// VALIDACIÓN DE USUARIO LOGUEADO
session_start();
if (isset($_SESSION['nombreUsuario']) && $_SESSION['idUsuario']){

    include_once("./login-val/db.php");

    $userId = $_SESSION['idUsuario'];

    $db = connect_db();

    $sql = "SELECT cobrador.idUsuario, cobrador.nombre, cobrador.apellido, cobrador.dni, COUNT(DISTINCT prestamo.id) AS cantidad_prestamos
            FROM cobrador
            LEFT JOIN prestamo ON cobrador.id = prestamo.idCobrador
            WHERE cobrador.idUsuario = ?
            GROUP BY cobrador.nombre";


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
        <title>Login</title>
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
        <header class="fixed-top d-flex align-items-center header-scrolled" style="background-color: white">
            <div class="container d-flex align-items-center justify-content-between">
                <div class="logo py-0 d-flex align-items-center" style="font-size: xx-large; color: black">
                    <img class="m-3" src="assets/icons/collaborator.png" width="80px">
                    <p class="m-0 px-2">Cobradores</p>
                </div>
                <nav class="navbar" id="navbar">
                    <ul class="row justify-content-center align-items-center contact text-black" style="font-weight: bold">
                        <li class= "col-auto justify-content-center align-items-center d-flex">
                            <img class="col-auto"  src="assets/icons/cube.png" style="height: 40px">
                            <a href="./main.php" class="col-auto m-0 p-0 px-2 text-black" style="font-weight: bold">Inicio</a>
                        </li>
                        <li class="col-auto php-email-form" style="min-width: 190px">
                            <input type="text" class="form-control" name="buscar" placeholder="Buscar"  required>
                        </li class="col-6">
                        <li onclick="openDiv()" class="col-auto justify-content-center align-items-center d-flex" style="cursor: pointer">
                            <img class="col-auto"  src="assets/icons/add.png" style="height: 40px">
                            <a class="col-auto m-0 p-0 px-2 text-black" style="font-weight: bold">Nuevo cobrador</a>
                        </li>
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav>
            </div>
        </header>

        <main id="main" class="d-flex align-items-center" style="margin-top: 112px; margin: 112px 10% 5% 10%;">

            <div class="struct" id="nuevopres">
                <div class="prompt">
                    <p>HOLA</p>
                    <div class="container">
                        <p>HOLA DE NUEVO</p>
                    
                    <!-- CONSULTAS A LA BASE DE DATOS PARA EXTRAER CLIENTES Y COBRADORES -->
                    <?php
                    $opciones_clientes = "SELECT cliente.id, cliente.nombre, cliente.apellido 
                                            FROM cliente
                                            ORDER BY cliente.nombre ASC";
                    $result_clientes = $db->query($opciones_clientes);

                    $opciones_cobrador = "SELECT cobrador.id, cobrador.nombre, cobrador.apellido
                                          FROM cobrador
                                          WHERE idUsuario = $userId
                                          ORDER BY cobrador.nombre ASC";
                    $result_cobradores = $db->query($opciones_cobrador);

                    $list_clientes = '';
                    $list_cobradores = '';

                    while ($row = $result_clientes->fetch_assoc()) {
                        $list_clientes .= "<option value='" . $row['id'] . "'>" . $row['nombre'] . ' ' . $row['apellido'] . "</option>";
                    }

                    while ($row = $result_cobradores->fetch_assoc()) {
                        $list_cobradores .= "<option value='" . $row['id'] . "'>" . $row['nombre'] . ' ' . $row['apellido'] . "</option>";
                    }
                    ?>

                    <label for="cliente">Selecciona un cliente:</label>
                    <select class="form-control" id="cliente" name="cliente">
                        <?php echo $list_clientes; ?>
                    </select>

                    <label for="cobrador">Selecciona un cobrador:</label>
                    <select class="form-control" id="cobrador" name="cobrador">
                        <?php echo $list_cobradores; ?>
                    </select>

                    <!-- FIN DE CONSULTA A BD PARA ELECCIÓN DE CLIENTE Y COBRADOR  -->
                    </div>
                    <button onclick="closeDiv()">Cerrar</button>

                    <!-- CREAR UN FORM DEL TIPO POST Y AGREGAR INPUT PARA MONTO, TASA Y CUOTAS-->
                </div>
            </div>

            <table class="table" style="border-collapse: separate; border-spacing: 0">
                <thead class="thead-dark text-center" style="border: transparent">
                <tr>
                    <th scope="col">Colaborador</th>
                    <th scope="col">DNI</th>
                    <th scope="col">Clientes a cargo</th>
                    <th scope="col">Clientes con deuda</th>
                    <th scope="col">Botones</th>
                </tr>
                </thead>
                <tbody class="align-middle justify-content-center">
                <?php

                while ($row = $result -> fetch_assoc()){
                    echo "<tr class='text-center' style='background-color: #FBF4EE; border: transparent;'>";
                    echo "<td>" . strtoupper($row['nombre']) .' '.strtoupper($row['apellido'])."</td>";
                    echo "<td>" . $row['dni'] . "</td>";
                    echo "<td>" . $row['cantidad_prestamos'] . "</td>";
                    echo "<td>" . $row['cantidad_prestamos'] . "</td>"; ; //FALTA PONER LA LÓGICA PARA DETERMINAR SI HAY CLIENTES MOROSOS (Parece que se debe crear un campo en la tabla 'prestamo')
                    echo '<td class="contact">
                            <div class="php-email-form">
                                <button class="mx-1 my-1" style="width: fit-content; padding: 5px 10px" type="submit">Ver</button>
                            </div>
                          </td>';
                    echo "</tr>";
                }

                ?>
                </tbody>
            </table>
        </main>


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
//FIN DE VALIDACIÓN
}else{
    header("Location:./login.php");
    exit;
}
?>