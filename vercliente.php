<?php
// VALIDACIÓN DE USUARIO LOGUEADO
session_start();
if (isset($_GET['id']) && isset($_SESSION['nombreUsuario']) && $_SESSION['idUsuario']) {
    include_once("./login-val/db.php");

    $userId = $_SESSION['idUsuario'];
    $idCliente = $_GET['id'];

    $db = connect_db();

    $sqlCliente = "SELECT cliente.nombre AS nombreCliente, cliente.apellido AS apellidoCliente, cliente.tipodocumento, cliente.documento, cliente.telefono, cliente.direccion 
                    FROM cliente
                    WHERE cliente.id = ?";

    $stmtCliente = $db->prepare($sqlCliente);
    $stmtCliente->bind_param("i", $idCliente);
    $stmtCliente->execute();
    $resultCliente = $stmtCliente->get_result();
    $row = $resultCliente->fetch_assoc();

    $nombreCliente = $row['nombreCliente'];
    $apellidoCliente = $row['apellidoCliente'];
    $tipodocumentoCliente = $row['tipodocumento'];
    $documentoCliente = $row['documento'];
    $telefonoCliente = $row['telefono'];
    $direccionCliente = $row['direccion'];

    $sql = "SELECT prestamo.id AS idPrestamo, cliente.nombre AS nombreCliente, cliente.apellido AS apellidoCliente, cliente.documento, cliente.telefono, cliente.direccion, cobrador.nombre AS nombreCobrador, cobrador.apellido AS apellidoCobrador, prestamo.monto, prestamo.tasa, prestamo.cuotas FROM prestamo 
            INNER JOIN cliente ON prestamo.idCliente = cliente.id
            INNER JOIN cobrador ON prestamo.idCobrador = cobrador.id
            WHERE cliente.id = ?";

    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $idCliente);
    $stmt->execute();
    $result = $stmt->get_result();

    mysqli_close($db);

 ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Info Cliente</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
              rel="stylesheet">

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

        <!--FUENTES-->
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>

        <style>
            header{
                animation: fadeDownAnimation ease 1s;
                animation-iteration-count: 1;
                animation-fill-mode: forwards;
            }

            table{
                animation: fadeUpAnimation ease 1s;
                animation-iteration-count: 1;
                animation-fill-mode: forwards;
            }

            #nuevopres{
                animation: blur ease 0.2s;
                animation-iteration-count: 1;
                animation-fill-mode: forwards;
            }

            .prompt{
                animation: fadeUpAnimationPrompt ease 0.5s;
                animation-iteration-count: 1;
                animation-fill-mode: forwards;
            }

            .fila{
                scale: 1;
                transition: all 0.2s ease-in;
                background-color: #264653;
                color: white;
            }
            .fila:hover{
                scale: 103%;
                background-color: #FBF4EE;
                color: black;
            }

            @keyframes fadeUpAnimation {
                0%{
                    margin-top: 100px;
                    opacity: 0;
                }
                100%{
                    margin-top: initial;
                    opacity: 1;
                }
            }

            @keyframes fadeDownAnimation {
                0%{
                    margin-top: -50px;
                    opacity: 0;
                }
                100%{
                    margin-top: initial;
                    opacity: 1;
                }
            }

            @keyframes blur {
                0%{
                    backdrop-filter: blur(0px);
                }
                100%{
                    backdrop-filter: blur(4px);
                }
            }

            @keyframes fadeUpAnimationPrompt {
                0%{
                    margin-top: 250px;
                    opacity: 0;
                }
                100%{
                    margin-top: 150px;
                    opacity: 1;
                }
            }


        </style>
    </head>
    <body style="min-width: 770px">

    <!-- ============== POP-UP EDICIÓN DE CLIENTE ============== -->
    <div class="struct" id="editCliente" style="z-index: 2">
        <div class="prompt">
            <p style="margin-top: ; font-weight: 600; font-family: Raleway; font-size: 28px; text-align: center">Editar cliente</p>
            <form class="container" method="POST" action="./cliente/editCliente.php">
                <div class="row p-0 m-0">
                    <div class="inputId" style="display: none">
                        <input type="number" readonly="readonly" class="form-control" id="idClienteEdit"
                               name="idClienteEdit"
                               style="float: right; text-align: right; border: 1px solid whitesmoke;color:whitesmoke; background-color: whitesmoke; width:10px;">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="nombreEdit" style="font-family: Raleway; font-weight: 600; font-size: 16px">Nombre:</label>
                        <input type="text" class="form-control" id="nombreEdit" name="nombreEdit" required
                               style="font-family: Raleway; font-weight: 600; font-size: 16px">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="apellidoEdit" style="font-family: Raleway; font-weight: 600; font-size: 16px">Apellido:</label>
                        <input type="text" class="form-control" id="apellidoEdit" name="apellidoEdit" required
                               style="font-family: Raleway; font-weight: 600; font-size: 16px">
                    </div>
                </div>

                <div class="row p-0 m-0 align-content-center justify-content-center">
                    <div class="col-7 mb-3">
                        <label for="documentoEdit" style="font-family: Raleway; font-weight: 600; font-size: 16px">Documento de identidad:</label>
                        <input type="text" class="form-control" id="documentoEdit" name="documentoEdit" maxlength="8" pattern="^[0-9]{8}$" required
                               style="font-family: Raleway; font-weight: 600; font-size: 16px">
                    </div>
                    <div class="col-5 mb-3">
                        <div class="form-check custom-radio px-0">
                            <input type="radio" name="tipodocumentoEdit" value="dni" id="dni" required> DNI
                            <input type="radio" name="tipodocumentoEdit" value="carnetext" id="carnetext" required> Carnet Extranjería
                        </div>
                    </div>
                    <div class="row p-0 m-0">
                        <div class="col-6 mb-3">
                            <label for="direccionEdit" style="font-family: Raleway; font-weight: 600; font-size: 16px">Dirección:</label>
                            <input type="text" class="form-control" id="direccionEdit" name="direccionEdit" required="font-family: Raleway; font-weight: 600; font-size: 16px">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="telefonoEdit" style="font-family: Raleway; font-weight: 600; font-size: 16px">Teléfono:</label>
                            <input type="text" class="form-control" id="telefonoEdit" name="telefonoEdit" required maxlength="9"
                                   pattern="^[0-9]{9}$" style="font-family: Raleway; font-weight: 600; font-size: 16px">
                        </div>
                    </div>
                </div>

                <button class="mx-1 my-1"
                        style="width: fit-content; padding: 5px 10px; border-radius: 5px; background-color: #2A9D8F; color: white; font-family: Raleway; font-weight: 600; font-size: 14px"
                        type="submit">Aceptar
                </button>

                <button onclick="closeDiv()" class="mx-1 my-1"
                        style="width: fit-content; padding: 5px 10px; border-radius: 5px; background-color: slategray; color: white; font-family: Raleway; font-weight: 600; font-size: 14px"
                        type="button">Cancelar
                </button>

            </form>
        </div>
    </div>
    <!-- ============== FIN POP-UP EDICIÓN DE CLIENTE ============== -->

    <!-- ============== POP-UP ELIMINAR PRÉSTAMO ============== -->
    <div class="struct" id="eliminar" style="z-index: 2;">
        <div class="prompt">

            <p style="margin-top: ; font-weight: 600; font-family: Raleway; font-size: 28px; text-align: center">¿Seguro que quieres borrar el préstamo?</p>
            <button class="mx-1 my-1" style="width: fit-content; padding: 5px 10px; border-radius: 5px; background-color: #2A9D8F; color: white; font-family: Raleway; font-weight: 600; font-size: 14px" type="submit">Aceptar</button>

            <button onclick="closeDivdelete()" class="mx-1 my-1" style="width: fit-content; padding: 5px 10px; border-radius: 5px; background-color: slategray; color: white; font-family: Raleway; font-weight: 600; font-size: 14px" type="submit">Cancelar</button>


        </div>
    </div>
    <!-- ============== FIN POP-UP ELIMINAR PRÉSTAMO ============== -->

    <!-- ======== NAV BAR ========== -->

    <header class="fixed-top d-flex align-items-center header-scrolled" style="background-color: white">
        <div class="container d-flex align-items-center justify-content-between">
            <div class="logo py-0 d-flex align-items-center" style="font-size: xx-large; color: black">
                <img class="m-3" src="assets/icons/client.png" width="80px">
                <p class="m-0 px-2" style="font-size: 25px; font-family: Raleway">
                    <?php echo $nombreCliente." ".$apellidoCliente ?>
                </p>
                <div class="col mx-4" style="margin-left: auto;color: black;font-family: Raleway;font-weight: 600;font-size: 15px">
                    <p class="my-3 p-0">DNI:  <?php echo $documentoCliente?></p>
                    <p class="mb-3 p-0">Teléfono:  <?php echo $telefonoCliente ?></p>
                    <p class="mb-3 p-0">Dirección: <?php echo$direccionCliente?></p>
                </div>
            </div>

            <!-- COPROBAR EDICIÓN DE CLIENTE -->

            <nav class="navbar" id="navbar">
                <ul class="row justify-content-center align-items-center contact text-black" style="font-weight: bold">
                    <li class="col-auto justify-content-center align-items-center d-flex">
                        <img class="col-auto" src="assets/icons/cube.png" style="height: 40px">
                        <a href="./main.php" class="col-auto m-0 p-0 px-2 text-black"
                           style="font-family: Raleway; font-weight: 600; font-size: 20px">Inicio</a>
                    </li>
                    <li class="col-auto php-email-form" style="min-width: 190px">
                        <input type="text" class="form-control" name="buscar" placeholder="Buscar" required>
                    </li class="col-6">
                    <li onclick="openDiv('<?php echo $idCliente; ?>','<?php echo $nombreCliente; ?>', '<?php echo $apellidoCliente; ?>', '<?php echo $documentoCliente; ?>', '<?php echo $telefonoCliente; ?>', '<?php echo $direccionCliente; ?>')" class="col-auto justify-content-center align-items-center d-flex"
                        style="cursor: pointer">
                        <img class="col-auto" src="assets/icons/modify.png" style="height: 40px">
                        <a class="col-auto m-0 p-0 px-2 text-black"
                           style="font-family: Raleway; font-weight: 600; font-size: 20px">Modificar datos</a>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
    </header>
    <!-- ======== FIN NAV BAR ========== -->

    <!-- INICIO Script para eliminar prestamo -->
    <script>
        function openDivdelete(){
            let get=document.querySelector('#eliminar')
            get.style.display = 'block'
        }

        function closeDivdelete(){
            let get = document.querySelector('#eliminar')
            get.style.display = 'none'
        }
    </script>
    <!-- FIN Script para eliminar prestamo -->

    <main id="main" class="d-flex align-items-center justify-content-center"  style="margin-top: 112px; margin: 112px 10% 5% 10%;">
        <table class="table" style="table-layout: fixed; border-collapse: separate; border-spacing: 0 15px; max-width: 79.35%; min-width: 646px">
            <thead class="thead-dark text-center"
                   style="border: transparent; font-family: Raleway; font-size: 20px;font-weight: 600;color: #264653">
            <tr>
                <th scope="col">Cobrador</th>
                <th scope="col">Monto prestado (S/)</th>
                <th scope="col">Tasa (%)</th>
                <th scope="col"># Cuotas</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody class="align-middle justify-content-center">
            <?php
            if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr class='text-center fila' style='color: black ;background-color: #FBF4EE; border: transparent;font-family: Roboto;font-weight: 600; font-size: 15px; z-index: 1'>";
                echo "<td>" . $row['nombreCobrador'] ." ". $row['apellidoCobrador'] . "</td>";
                echo "<td>" . $row['monto']. "</td>";
                echo "<td>" . $row['tasa']. "</td>";
                echo "<td>" . $row['cuotas'] ."</td>";
                echo '<td class="contact" >
                    <div class="php-email-form" >
                        <a href="./verprestamocliente.php?idPrestamo=' . $row['idPrestamo'] . '">
                            <button class="mx-1 my-1" style = "width: fit-content; padding: 5px 10px; border-radius: 5px; background-color: #2A9D8F; color: white; font-family: Raleway; font-weight: 600; font-size: 14px" type = "submit" > Ver</button >
                        </a >
                        <button type = "submit" onclick = "openDivdelete()" class="mx-1 my-1" style = "width: fit-content; padding: 5px 10px; border-radius: 5px; background-color: #a52834; color: white; font-family: Raleway; font-weight: 600; font-size: 14px" > Eliminar</button >

                    </div >
                </td >';

                echo "</tr>";
            }} else{
                echo "<td colspan='5' class='text-center'>" . "NO SE ENCONTRARON DEUDAS". "</td>";
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
    <script>
        function openDiv(idCliente, nombreCliente, apellidoCliente, documento, telefono, direccion ) {
            let get = document.querySelector('#editCliente');
            get.style.display = 'block';
            document.getElementById("idClienteEdit").value = idCliente;
            document.getElementById("nombreEdit").value = nombreCliente;
            document.getElementById("apellidoEdit").value = apellidoCliente;
            document.getElementById("documentoEdit").value = documento;
            document.getElementById("telefonoEdit").value = telefono;
            document.getElementById("direccionEdit").value = direccion;

        }
    </script>
    </body>
    </html>

<?php
//FIN DE VALIDACIÓN SI HAY SESIÓN INICIADA
} else {
    header("Location:./login.php");
    exit;
}
?>