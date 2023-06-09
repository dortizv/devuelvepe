<?php
// VALIDACIÓN DE USUARIO LOGUEADO
    session_start();
    if (isset($_GET['id']) && isset($_SESSION['nombreUsuario']) && $_SESSION['idUsuario']) {
        include_once("./db/db.php");

    $userId = $_SESSION['idUsuario'];
    $idCobrador = $_GET['id'];

    $db = connect_db();

    $sqlCobrador = "SELECT cobrador.nombre AS nombreCobrador, cobrador.apellido AS apellidoCobrador, cobrador.dni, cobrador.telefono
                   FROM cobrador
                   WHERE cobrador.id = ?";

    $stmtCobrador = $db->prepare($sqlCobrador);
    $stmtCobrador->bind_param("i", $idCobrador);
    $stmtCobrador->execute();
    $resultCobrador = $stmtCobrador->get_result();
    $row = $resultCobrador->fetch_assoc();

    $nombreCobrador = $row['nombreCobrador'];
    $apellidoCobrador = $row['apellidoCobrador'];
    $documentoCobrador = $row['dni'];
    $telefonoCobrador = $row['telefono'];

    $sql = "SELECT prestamo.id AS idPrestamo, cliente.nombre AS nombreCliente, cliente.apellido AS apellidoCliente, cliente.documento, cliente.telefono, cliente.direccion, cobrador.nombre AS nombreCobrador, cobrador.apellido AS apellidoCobrador FROM prestamo 
            INNER JOIN cliente ON prestamo.idCliente = cliente.id
            INNER JOIN cobrador ON prestamo.idCobrador = cobrador.id
            WHERE cobrador.id = ?
            GROUP BY cliente.documento";

    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $idCobrador);
    $stmt->execute();
    $result = $stmt->get_result();

?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
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

    <!-- ============== POP-UP EDICIÓN DE COBRADOR ============== -->
    <div class="struct" id="editCobrador" style="z-index: 2">
        <div class="prompt">

            <p style="margin-top: ; font-weight: 600; font-family: Raleway; font-size: 28px; text-align: center">Editar cobrador</p>
            <form class="container" method="POST" action="./cobrador/editCobrador.php">
                <div class="inputId" style="display: none">
                    <input type="number" readonly="readonly" class="form-control" id="idCobradorEdit"
                           name="idCobradorEdit"
                           style="float: right; text-align: right; border: 1px solid whitesmoke;color:whitesmoke; background-color: whitesmoke; width:10px;">
                </div>
                <div class="row p-0 m-0">
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
                    <div class="col-6 mb-3">
                        <label for="documentoEdit" style="font-family: Raleway; font-weight: 600; font-size: 16px">DNI:</label>
                        <input type="text" class="form-control" id="documentoEdit" name="documentoEdit" maxlength="8" pattern="^[0-9]{8}$" required
                               style="font-family: Raleway; font-weight: 600; font-size: 16px">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="telefonoEdit" style="font-family: Raleway; font-weight: 600; font-size: 16px">Teléfono:</label>
                        <input type="text" class="form-control" id="telefonoEdit" name="telefonoEdit" maxlength="9" pattern="^[0-9]{9}$"
                               required style="font-family: Raleway; font-weight: 600; font-size: 16px">
                        </div>
                </div>

                <button class="mx-1 my-1"
                        style="width: fit-content; padding: 5px 10px; border-radius: 5px; background-color: #2A9D8F; color: white; font-family: Raleway; font-weight: 600; font-size: 14px"
                        type="submit">Aceptar
                </button>

                <button onclick="closeDiveditar()" class="mx-1 my-1"
                        style="width: fit-content; padding: 5px 10px; border-radius: 5px; background-color: slategray; color: white; font-family: Raleway; font-weight: 600; font-size: 14px"
                        type="button">Cancelar
                </button>
        </div>

            </form>


        </div>
    </div>
    <!-- ============== FIN POP-UP EDICIÓN DE COBRADOR ============== -->

    <!-- ======== NAV BAR ========== -->

    <header class="fixed-top d-flex align-items-center header-scrolled" style="background-color: white">
        <div class="container d-flex align-items-center justify-content-between">
            <div class="logo py-0 d-flex align-items-center" style="font-size: xx-large; color: black">
                <img class="m-3" src="assets/icons/client.png" width="80px">
                <p class="m-0 px-2" style="font-size: 25px; font-family: Raleway">
                    <?php echo $nombreCobrador. " ".$apellidoCobrador;?>
                </p>
                <div class="col mx-4" style="margin-left: auto;color: black;font-family: Raleway;font-weight: 600;font-size: 15px">
                    <p class="my-3 p-0">DNI: <?php echo $documentoCobrador; ?> </p>
                    <p class="mb-3 p-0">Teléfono:  <?php echo $telefonoCobrador; ?> </p>
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
                    <li onclick="openDiv('<?php echo $idCobrador; ?>','<?php echo $nombreCobrador; ?>', '<?php echo $apellidoCobrador; ?>', '<?php echo $documentoCobrador; ?>', '<?php echo $telefonoCobrador; ?>')" class="col-auto justify-content-center align-items-center d-flex"
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
                <th scope="col">Clientes</th>
                <th scope="col">DNI</th>
                <th scope="col">Tasa</th>
                <th scope="col">Dirección</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody class="align-middle justify-content-center">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr class='text-center fila' style='color: black ;background-color: #FBF4EE; border: transparent;font-family: Roboto;font-weight: 600; font-size: 15px; z-index: 1'>";
                    echo "<td>" . $row['nombreCliente'] ." ". $row['apellidoCliente'] . "</td>";
                    echo "<td>" . $row['documento']. "</td>";
                    echo "<td>" . $row['telefono']. "</td>";
                    echo "<td>" . $row['direccion'] ."</td>";

                    echo '<td class="contact">
                        <div class="php-email-form" >
                            <button class="mx-1 my-1" style = "width: fit-content; padding: 5px 10px; border-radius: 5px; background-color: #E9C46A; color: black; font-family: Raleway; font-weight: 600; font-size: 14px" type = "submit" >Activo</button >
                        </div>
                    </td>';
                    echo "</tr>";
                }} else{
                echo "<td colspan='5' class='text-center'>" . "NO SE ENCONTRARON PRÉSTAMOS". "</td>";
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
        function openDiv(idCobrador, nombreCobradror, apellidoCobrador, documento, telefono) {
            let get = document.querySelector('#editCobrador');
            get.style.display = 'block';
            document.getElementById("idCobradorEdit").value = idCobrador;
            document.getElementById("nombreEdit").value = nombreCobradror;
            document.getElementById("apellidoEdit").value = apellidoCobrador;
            document.getElementById("documentoEdit").value = documento;
            document.getElementById("telefonoEdit").value = telefono;
        }
        function closeDiveditar(){
            let get = document.querySelector('#editCobrador');
            get.style.display = 'none';
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