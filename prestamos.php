<?php
// VALIDACIÓN DE USUARIO LOGUEADO
session_start();
if (isset($_SESSION['nombreUsuario']) && $_SESSION['idUsuario']){

include_once("./login-val/db.php");

$userId = $_SESSION['idUsuario'];

$db = connect_db();

$sql = "SELECT prestamo.idCliente, cliente.nombre, cliente.apellido, prestamo.monto, prestamo.cuotas, prestamo.tasa, prestamo.fecha 
            FROM prestamo 
            INNER JOIN cobrador ON cobrador.id = prestamo.idCobrador
            INNER JOIN usuario ON usuario.id=cobrador.id 
            INNER JOIN cliente ON prestamo.idCliente = cliente.id 
            WHERE usuario.id = ?";


$stmt = $db->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

//
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
                    <img class="m-3" src="assets/icons/borrow.png" width="80px">
                    <p class="m-0 px-2">Préstamos</p>
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
                            <a class="col-auto m-0 p-0 px-2 text-black" style="font-weight: bold">Nuevo préstamo</a>
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
                    <button onclick="closeDiv()">Cerrar</button>
                </div>
            </div>

            <table class="table" style="border-collapse: separate; border-spacing: 0">
                <thead class="thead-dark text-center" style="border: transparent">
                <tr>
                    <th scope="col">Clientes</th>
                    <th scope="col">Cuotas</th>
                    <th scope="col">Deuda Total</th>
                    <th scope="col">Próximo pago</th>
                    <th scope="col">Tasa (%)</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody class="align-middle justify-content-center">
                <?php
                while ($row = $result -> fetch_assoc()){
                    echo "<tr class='text-center' style='background-color: #FBF4EE; border: transparent;'>";
                    echo "<td>" . $row['nombre'] .' '.$row['apellido']."</td>";
                    echo "<td>" . $row['cuotas'] . "</td>";
                    echo "<td>" . $row['monto'] . "</td>";
                    echo "<td>" . $row['fecha'] . "</td>";
                    echo "<td>" . $row['tasa'] . "</td>";
                    echo '<td class="contact">
                            <div class="php-email-form">
                                <button class="mx-1 my-1" style="width: fit-content; padding: 5px 10px" type="submit">Editar</button>
                                <button class="mx-1 my-1" style="background-color: lightgray; width: fit-content; padding: 5px 10px" type="submit">Amortizar</button>
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
    header("Location:./../login.php");
    exit;
}
?>