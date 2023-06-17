<?php
// VALIDACIÓN DE USUARIO LOGUEADO
session_start();
if (isset($_SESSION['nombreUsuario']) && $_SESSION['idUsuario']) {

    include_once("./db/db.php");

    $userId = $_SESSION['idUsuario'];

    $db = connect_db();

    $sql = "SELECT DISTINCT cliente.id, cliente.nombre, cliente.apellido, cliente.tipodocumento, cliente.documento 
            FROM cliente 
            WHERE cliente.idUsuario = ?";


    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
 ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Clientes</title>
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

    <!-- ============== POP-UP CREACIÓN DE NUEVO CLIENTE ============== -->
    <div class="struct" id="nuevopres" style="z-index: 2">
        <div class="prompt">

            <p style="margin-top: ; font-weight: 600; font-family: Raleway; font-size: 28px; text-align: center">Nuevo cliente</p>
            <form class="container" method="POST" action="./cliente/addCliente.php">
                <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['idUsuario']; ?>">
                <div class="row p-0 m-0">
                    <div class="col-6 mb-3">
                        <label for="nombreAdd" style="font-family: Raleway; font-weight: 600; font-size: 16px">Ingresar nombre:</label>
                        <input type="text" class="form-control" id="nombreAdd" name="nombreAdd" required
                               style="font-family: Raleway; font-weight: 600; font-size: 16px">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="apellidoAdd" style="font-family: Raleway; font-weight: 600; font-size: 16px">Ingresar apellido:</label>
                        <input type="text" class="form-control" id="apellidoAdd" name="apellidoAdd" required
                               style="font-family: Raleway; font-weight: 600; font-size: 16px">
                    </div>
                </div>

                <div class="row p-0 m-0 align-content-center justify-content-center">
                    <div class="col-7 mb-3">
                        <label for="documentoAdd" style="font-family: Raleway; font-weight: 600; font-size: 16px">Ingresar documento de identidad:</label>
                        <input type="text" class="form-control" id="documentoAdd" name="documentoAdd" maxlength="8" pattern="^[0-9]{8}$" required
                               style="font-family: Raleway; font-weight: 600; font-size: 16px">
                    </div>
                    <div class="col-5 mb-3">
                        <label for="tipodocumentoAdd" style="font-family: Raleway; font-weight: 600; font-size: 16px">Tipo de documento</label>
                        <div class="form-check custom-radio px-0">
                            <input type="radio" name="tipodocumentoAdd" value="dni" id="dni" required> DNI
                            <input type="radio" name="tipodocumentoAdd" value="carnetext" id="carnetext" required> Carnet Extranjería
                        </div>
                    </div>
                    <div class="row p-0 m-0">
                        <div class="col-6 mb-3">
                            <label for="direccionAdd" style="font-family: Raleway; font-weight: 600; font-size: 16px">Ingresar dirección:</label>
                            <input type="text" class="form-control" id="direccionAdd" name="direccionAdd" style="font-family: Raleway; font-weight: 600; font-size: 16px">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="telefonoAdd" style="font-family: Raleway; font-weight: 600; font-size: 16px">Ingresar teléfono:</label>
                            <input type="text" class="form-control" id="telefonoAdd" name="telefonoAdd" maxlength="9" pattern="^[0-9]{9}$"
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
                        type="submit">Cancelar
                </button>

            </form>


        </div>
    </div>
    <!-- ============== FIN CREACIÓN DE POP-UP NUEVO CLIENTE ============== -->

    <!-- ======== NAV BAR ========== -->

    <header class="fixed-top d-flex align-items-center header-scrolled" style="background-color: white">
        <div class="container d-flex align-items-center justify-content-between">
            <div class="logo py-0 d-flex align-items-center" style="font-size: xx-large; color: black">
                <img class="m-3" src="assets/icons/client.png" width="80px">
                <p class="m-0 px-2" style="font-size: 25px; font-family: Raleway">Clientes</p>
            </div>
            <nav class="navbar" id="navbar">
                <ul class="row justify-content-center align-items-center contact text-black" style="font-weight: bold">
                    <li class="col-auto justify-content-center align-items-center d-flex">
                        <a href="./main.php">
                            <img class="col-auto" src="assets/icons/cube.png" style="height: 40px">
                            <p class="col-auto m-0 p-0 px-2 text-black"
                               style="font-family: Raleway; font-weight: 600; font-size: 20px">Inicio</p>
                        </a>
                    </li>
                    <li class="col-auto php-email-form" style="min-width: 190px">
                        <input type="text" class="form-control" name="buscar" placeholder="Buscar" required>
                    </li class="col-6">
                    <li onclick="openDiv()" class="col-auto justify-content-center align-items-center d-flex"
                        style="cursor: pointer">
                        <img class="col-auto" src="assets/icons/add.png" style="height: 40px">
                        <a class="col-auto m-0 p-0 px-2 text-black"
                           style="font-family: Raleway; font-weight: 600; font-size: 20px">Nuevo cliente</a>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
    </header>
    <!-- ======== FIN NAV BAR ========== -->


    <main id="main" class="d-flex align-items-center justify-content-center"
          style="margin-top: 112px; margin: 112px 10% 5% 10%;">
        <table class="table"
               style="table-layout: fixed; border-collapse: separate; border-spacing: 0 15px; max-width: 79.35%; min-width: 646px">
            <thead class="thead-dark text-center"
                   style="border: transparent; font-family: Raleway; font-size: 20px;font-weight: 600;color: #264653">
            <tr>
                <th scope="col">Clientes</th>
                <th scope="col">Documento</th>
                <th scope="col">N° Documento</th>
                <th scope="col">Estado</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody class="align-middle justify-content-center">
            <?php

            while ($row = $result->fetch_assoc()) {
                echo "<tr class='text-center fila' style='border: transparent;font-family: Roboto;font-weight: 600; font-size: 15px; z-index: 1;'>";
                echo "<td>" . strtoupper($row['nombre']) . ' ' . strtoupper($row['apellido']) . "</td>";
                echo "<td>" . strtoupper($row['tipodocumento']) . "</td>";
                echo "<td>" . $row['documento'] . "</td>";
                echo "<td>Activo</td>"; //FALTA PONER LA LÓGICA PARA DETERMINAR SI ES ACTIVO O NO (Parece que se debe crear un campo en la tabla 'prestamo')
                echo '<td class="contact">
                            <div class="php-email-form">
                                <a href="./vercliente.php?id=' . $row['id'] . '">
                                    <button class="mx-1 my-1" style="width: fit-content; padding: 5px 10px; border-radius: 5px; background-color: #E9C46A; color: black; font-family: Raleway; font-weight: 600; font-size: 14px" type="submit">Ver</button>
                                </a>
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
//FIN DE VALIDACIÓN SI HAY SESIÓN INICIADA
} else {
    header("Location:./login.php");
    exit;
}
?>