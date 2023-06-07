<?php
// VALIDACIÓN DE USUARIO LOGUEADO
session_start();
if (isset($_SESSION['nombreUsuario']) && $_SESSION['idUsuario']){

    include_once("./login-val/db.php");

    $userId = $_SESSION['idUsuario'];

    $db = connect_db();

    $sql = "SELECT DISTINCT prestamo.idCliente, cliente.nombre, cliente.apellido, cliente.tipodocumento, cliente.documento 
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

        <!--FUENTES-->
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>


    </head>
    <body style="min-width: 770px">

        <!-- nuevo cliente -->
        <div class="struct" id="nuevopres">
            <div class="prompt">
                <div style="text-align: end; margin: 0px 16px" onclick="closeDiv()">
                    <svg style="width: 15px; position: absolute; align" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve">
                    <g><path d="M498.9,615.4c-2.5,3.4-3.7,5.6-5.4,7.3c-113.6,113.7-227.2,227.3-340.9,341c-24.4,24.4-53.5,32.4-86.4,21.7c-58-18.9-75.3-92.4-32-136C95.1,788,156.5,727,217.7,665.8c53.3-53.3,106.6-106.6,159.9-159.9c1.6-1.6,3-3.2,6-6.4c-2.7-1.9-5.5-3.4-7.6-5.5c-112.4-112.3-224.8-224.7-337.1-337C7.2,125.3,3.7,79.4,30.2,46.1c30.7-38.5,86.1-41.8,121.9-6.9c26.1,25.5,51.7,51.5,77.5,77.3c87.9,87.8,175.7,175.7,263.5,263.6c1.6,1.6,2.5,3.7,4,5.9c2.9-2.8,4.5-4.3,6.1-5.8C618.3,265.1,733.4,150,848.5,35C888.5-4.9,953.1,4.1,980,53.1c17.6,32,11.8,71.2-14.8,98c-31.4,31.6-63,63.1-94.6,94.6c-83.7,83.7-167.4,167.4-251.1,251.1c-1.4,1.4-2.8,2.9-5.8,6.1c4.4,3.7,9.1,7,13,10.9c111,110.9,221.9,221.8,332.8,332.8c28.6,28.6,33.4,69.4,12.7,102.5c-27.9,44.6-89.3,51.5-127.2,13.9c-47.6-47.2-94.9-94.8-142.4-142.3c-65.9-65.9-131.8-131.8-197.7-197.8C503.2,621.2,501.8,619.1,498.9,615.4z"/></g>
                    </svg>
                </div>

                <p style="margin-top: ; font-weight: 600; font-family: Raleway; font-size: 28px; text-align: center">Nuevo cliente</p>
                <div class="container">
                    <div class="row p-0 m-0">
                        <div class="col-6 mb-3">
                            <label for="nombre" style="font-family: Raleway; font-weight: 600; font-size: 16px">Ingrear nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" style="font-family: Raleway; font-weight: 600; font-size: 16px">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="apellido" style="font-family: Raleway; font-weight: 600; font-size: 16px">Ingrear apellido:</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" style="font-family: Raleway; font-weight: 600; font-size: 16px">
                        </div>
                    </div>

                    <div class="row p-0 m-0 align-content-center justify-content-center">
                        <div class="col-7 mb-3">
                            <label for="documento" style="font-family: Raleway; font-weight: 600; font-size: 16px">Ingrear documento de identidad:</label>
                            <input type="text" class="form-control" id="documento" name="documento" style="font-family: Raleway; font-weight: 600; font-size: 16px">
                        </div>
                        <div class="col-5 mb-3">
                            <label for="tipododumento" style="font-family: Raleway; font-weight: 600; font-size: 16px">Tipo de documento</label>
                            <div class="form-check custom-radio px-0">
                                <input type="radio" name="tipodocumento" value="dni" id="dni" required> DNI
                                <input type="radio" name="tipodocumento" value="carnetext" id="carnetext" required> Carnet Extranjería
                            </div>
                        </div>
                        <div class="row p-0 m-0">
                            <div class="col-6 mb-3">
                                <label for="direccion" style="font-family: Raleway; font-weight: 600; font-size: 16px">Ingrear dirección:</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" style="font-family: Raleway; font-weight: 600; font-size: 16px">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="telefeno" style="font-family: Raleway; font-weight: 600; font-size: 16px">Ingresar teléfeno:</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" style="font-family: Raleway; font-weight: 600; font-size: 16px">
                            </div>
                        </div>
                    </div>

                    <button onclick="closeDiv()" class="mx-1 my-1" style="width: fit-content; padding: 5px 10px; border-radius: 5px; background-color: #2A9D8F; color: white; font-family: Raleway; font-weight: 600; font-size: 14px" type="submit">Aceptar</button>
                </div>


            </div>
        </div>

        <header class="fixed-top d-flex align-items-center header-scrolled" style="background-color: white">
            <div class="container d-flex align-items-center justify-content-between">
                <div class="logo py-0 d-flex align-items-center" style="font-size: xx-large; color: black">
                    <img class="m-3" src="assets/icons/client.png" width="80px">
                    <p class="m-0 px-2" style="font-size: 25px; font-family: Raleway">Clientes</p>
                </div>
                <nav class="navbar" id="navbar">
                    <ul class="row justify-content-center align-items-center contact text-black" style="font-weight: bold">
                        <li class= "col-auto justify-content-center align-items-center d-flex">
                            <img class="col-auto"  src="assets/icons/cube.png" style="height: 40px">
                            <a href="./main.php" class="col-auto m-0 p-0 px-2 text-black" style="font-family: Raleway; font-weight: 600; font-size: 20px">Inicio</a>
                        </li>
                        <li class="col-auto php-email-form" style="min-width: 190px">
                            <input type="text" class="form-control" name="buscar" placeholder="Buscar"  required>
                        </li class="col-6">
                        <li onclick="openDiv()" class="col-auto justify-content-center align-items-center d-flex" style="cursor: pointer">
                            <img class="col-auto"  src="assets/icons/add.png" style="height: 40px">
                            <a class="col-auto m-0 p-0 px-2 text-black" style="font-family: Raleway; font-weight: 600; font-size: 20px">Nuevo cliente</a>
                        </li>
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav>
            </div>
        </header>

        <main id="main" class="d-flex align-items-center justify-content-center" style="margin-top: 112px; margin: 112px 10% 5% 10%;">



            <table class="table" style="table-layout: fixed; border-collapse: separate; border-spacing: 0 15px; max-width: 79.35%; min-width: 646px">
                <thead class="thead-dark text-center" style="border: transparent; font-family: Raleway; font-size: 20px;font-weight: 600;color: #264653">
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

                while ($row = $result -> fetch_assoc()){
                    echo "<tr class='text-center' style='color: white ;background-color: #264653; border: transparent;font-family: Roboto;font-weight: 600; font-size: 15px'>";
                    echo "<td>" . strtoupper($row['nombre']) .' '. strtoupper($row['apellido']) . "</td>";
                    echo "<td>" . strtoupper($row['tipodocumento']) . "</td>";
                    echo "<td>" . $row['documento'] . "</td>";
                    echo "<td>Activo</td>"; //FALTA PONER LA LÓGICA PARA DETERMINAR SI ES ACTIVO O NO (Parece que se debe crear un campo en la tabla 'prestamo')
                    echo '<td class="contact">
                            <div class="php-email-form">
                                <button class="mx-1 my-1" style="width: fit-content; padding: 5px 10px; border-radius: 5px; background-color: #E9C46A; color: black; font-family: Raleway; font-weight: 600; font-size: 14px" type="submit">Ver</button>
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