<?php
session_start();
if (isset($_SESSION['nombreUsuario']) && $_SESSION['idUsuario']){
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main_style.css">
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>

    <title>Página principal</title>
</head>

<body style="min-width: 400px;">

<div class="container-fluid m-0 p-0">
    <div class="row bg-light">
        <div class="text-black col-auto px-5">
            consultas@devuelve.pe
        </div>
        <div class="text-black col-auto px-0">
            (800) 992-2139
        </div>
    </div>

    <div class="row m-auto py-2 justify-content-center" id="top-bar">
        <div class="image col-auto logo">
            <svg class="logo px-auto  mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 3184.98 785.53"><defs><style>.cls-1{fill:url(#linear-gradient);}.cls-2{fill:url(#linear-gradient-12);}.cls-3{fill:#fff;}</style><linearGradient id="linear-gradient" x1="1355.94" y1="-354.76" x2="1721.97" y2="969.05" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#f4a361"/><stop offset="0.48" stop-color="#f0af63"/><stop offset="1" stop-color="#e9c266"/></linearGradient><linearGradient id="linear-gradient-12" x1="251.45" y1="-45.1" x2="471.11" y2="749.34" xlink:href="#linear-gradient"/></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_16" data-name="Layer 16"><path class="cls-1" d="M106.17,385.26l101.9-95.79L311.8,368.18v-166c94.26,1.85,250.27-25.84,249,151.94-2.29,146.53-126,143.58-241.63,143.38v-83L0,601.57l318.51,184V706.82C468.29,723,706.78,673.19,763.32,446c20.4-65.3,11.86-219.11-34.58-280.76C606.71-42.57,303.11,6.68,104.75,1.87Z"/><path class="cls-1" d="M920.31,440.48c2.18,40.35,25.08,66.53,60,66.53,22.91,0,43.08-11.45,48-30h73.07c-16.35,55.07-60.53,86.16-117.78,86.16-89.44,0-134.15-49.08-134.15-146.15,0-82.89,47.44-136.33,129.78-136.33s126,53.44,126,159.78Zm111.79-44.72C1031,356,1004.83,336.87,977,336.87c-28.35,0-51.8,21.81-54.53,58.89Z"/><path class="cls-1" d="M1194.6,556.09l-96-268.3h79.07L1233.86,465l56.71-177.23h74.71l-96.52,268.3Z"/><path class="cls-1" d="M1558.86,556.09V518.46c-18.54,30.54-46.35,44.72-83.43,44.72-53.44,0-91.07-39.81-91.07-98.71V287.79h70.89V453.57c0,33.81,15.27,50.17,45.26,50.17,36,0,55.08-25.63,55.08-61.08V287.79h70.35v268.3Z"/><path class="cls-1" d="M1721.91,440.48c2.18,40.35,25.09,66.53,60,66.53,22.9,0,43.08-11.45,48-30H1903c-16.36,55.07-60.53,86.16-117.79,86.16C1695.74,563.18,1651,514.1,1651,417c0-82.89,47.44-136.33,129.79-136.33s126,53.44,126,159.78Zm111.79-44.72c-1.09-39.8-27.26-58.89-55.08-58.89-28.35,0-51.8,21.81-54.53,58.89Z"/><path class="cls-1" d="M1931.31,556.09V189.63h70.89V556.09Z"/><path class="cls-1" d="M2115.62,556.09l-96-268.3h79.08L2154.88,465l56.72-177.23h74.71l-96.53,268.3Z"/><path class="cls-1" d="M2351.74,440.48c2.18,40.35,25.08,66.53,60,66.53,22.91,0,43.08-11.45,48-30h73.08c-16.36,55.07-60.54,86.16-117.79,86.16-89.44,0-134.15-49.08-134.15-146.15,0-82.89,47.44-136.33,129.78-136.33s126,53.44,126,159.78Zm111.79-44.72c-1.09-39.8-27.27-58.89-55.08-58.89-28.35,0-51.8,21.81-54.53,58.89Z"/><path class="cls-1" d="M2546.42,556.09V482.47h75.8v73.62Z"/><path class="cls-1" d="M2650,683.15V287.79h68.17l.54,32.72c16.91-27.27,42-39.81,74.71-39.81,67.62,0,116.16,53.44,116.16,144,0,81.25-40.9,138.51-110.16,138.51-33.26,0-59.44-13.64-79.61-42v162Zm187.59-263.39c0-48-25.08-81.25-60.53-81.25-33.81,0-60,31.62-60,76.89,0,58.34,20.18,87.25,59.44,87.25C2818,502.65,2837.61,474.84,2837.61,419.76Z"/><path class="cls-1" d="M3000.11,440.48c2.18,40.35,25.09,66.53,60,66.53,22.9,0,43.08-11.45,48-30h73.07c-16.36,55.07-60.53,86.16-117.79,86.16-89.43,0-134.15-49.08-134.15-146.15,0-82.89,47.44-136.33,129.79-136.33s126,53.44,126,159.78Zm111.79-44.72c-1.09-39.8-27.26-58.89-55.07-58.89-28.36,0-51.81,21.81-54.54,58.89Z"/><path class="cls-2" d="M106.17,385.26l101.9-95.79L311.8,368.18v-166c94.26,1.85,250.27-25.84,249,151.94-2.29,146.53-126,143.58-241.63,143.38v-83L0,601.57l318.51,184V706.82C468.29,723,706.78,673.19,763.32,446c20.4-65.3,11.86-219.11-34.58-280.76C606.71-42.57,303.11,6.68,104.75,1.87Z"/><path class="cls-3" d="M920.31,440.48c2.18,40.35,25.08,66.53,60,66.53,22.91,0,43.08-11.45,48-30h73.07c-16.35,55.07-60.53,86.16-117.78,86.16-89.44,0-134.15-49.08-134.15-146.15,0-82.89,47.44-136.33,129.78-136.33s126,53.44,126,159.78Zm111.79-44.72C1031,356,1004.83,336.87,977,336.87c-28.35,0-51.8,21.81-54.53,58.89Z"/><path class="cls-3" d="M1194.6,556.09l-96-268.3h79.07L1233.86,465l56.71-177.23h74.71l-96.52,268.3Z"/><path class="cls-3" d="M1558.86,556.09V518.46c-18.54,30.54-46.35,44.72-83.43,44.72-53.44,0-91.07-39.81-91.07-98.71V287.79h70.89V453.57c0,33.81,15.27,50.17,45.26,50.17,36,0,55.08-25.63,55.08-61.08V287.79h70.35v268.3Z"/><path class="cls-3" d="M1721.91,440.48c2.18,40.35,25.09,66.53,60,66.53,22.9,0,43.08-11.45,48-30H1903c-16.36,55.07-60.53,86.16-117.79,86.16C1695.74,563.18,1651,514.1,1651,417c0-82.89,47.44-136.33,129.79-136.33s126,53.44,126,159.78Zm111.79-44.72c-1.09-39.8-27.26-58.89-55.08-58.89-28.35,0-51.8,21.81-54.53,58.89Z"/><path class="cls-3" d="M1931.31,556.09V189.63h70.89V556.09Z"/><path class="cls-3" d="M2115.62,556.09l-96-268.3h79.08L2154.88,465l56.72-177.23h74.71l-96.53,268.3Z"/><path class="cls-3" d="M2351.74,440.48c2.18,40.35,25.08,66.53,60,66.53,22.91,0,43.08-11.45,48-30h73.08c-16.36,55.07-60.54,86.16-117.79,86.16-89.44,0-134.15-49.08-134.15-146.15,0-82.89,47.44-136.33,129.78-136.33s126,53.44,126,159.78Zm111.79-44.72c-1.09-39.8-27.27-58.89-55.08-58.89-28.35,0-51.8,21.81-54.53,58.89Z"/><path class="cls-3" d="M2546.42,556.09V482.47h75.8v73.62Z"/><path class="cls-3" d="M2650,683.15V287.79h68.17l.54,32.72c16.91-27.27,42-39.81,74.71-39.81,67.62,0,116.16,53.44,116.16,144,0,81.25-40.9,138.51-110.16,138.51-33.26,0-59.44-13.64-79.61-42v162Zm187.59-263.39c0-48-25.08-81.25-60.53-81.25-33.81,0-60,31.62-60,76.89,0,58.34,20.18,87.25,59.44,87.25C2818,502.65,2837.61,474.84,2837.61,419.76Z"/><path class="cls-3" d="M3000.11,440.48c2.18,40.35,25.09,66.53,60,66.53,22.9,0,43.08-11.45,48-30h73.07c-16.36,55.07-60.53,86.16-117.79,86.16-89.43,0-134.15-49.08-134.15-146.15,0-82.89,47.44-136.33,129.79-136.33s126,53.44,126,159.78Zm111.79-44.72c-1.09-39.8-27.26-58.89-55.07-58.89-28.36,0-51.81,21.81-54.54,58.89Z"/></g></g></svg>
        </div>

    </div>
    <div class="row justify-content-center" id="contenedor">

        <div class="col" id="cont-central">
            <div class="row my-1">
                <p class="font-custom text-center p-0 mb-4" style="font-size: 1.5rem">
                <!-- MOSTRAR NOMBRE DE USUARIO --> 
                <?php echo isset($_SESSION['nombreUsuario']) ? '¡ Hola '.$_SESSION['nombreUsuario'].' !' : " ERROR DE SESIÓN"; ?>
                <!-- FIN MOSTRAR NOMBRE DE USUARIO --> 
                </p>
            </div>
            
            <div class="row d-flex justify-content-center">
                <div class="col-auto text-center justify-content-center pt-4 mx-4 mb-4 primary-buttons">
                    <div class="figure align-middle">
                        <a class="align-content-center" type="image" href="./cliente/listclientes.php">
                            <img src="assets/icons/client.png" height="100" width="100"/>
                        </a>
                        <p class="mt-3 mb-3 font-custom">Clientes</p>
                    </div>
                </div>
            
            <div class="col-auto text-center justify-content-center pt-4 mx-4 mb-4 primary-buttons">
                <div class="figure align-middle">
                    <a class="align-content-center" type="image" href="">
                        <img src="assets/icons/collaborator.png" height="100" width="100"/>
                    </a>
                        <p class="mt-3 mb-3 font-custom">Cobradores</p>
                </div>
            </div>
            
            <div class="col-auto text-center justify-content-center pt-4 mx-4 mb-4 primary-buttons">
                <div class="figure align-middle">
                    <a class="align-content-center" type="image" href="">
                        <img src="assets/icons/cobranza.png" height="100" width="100"/>
                    </a>
                    <p class="mt-3 mb-3 font-custom">Cobranza de préstamos</p>
                </div>
            </div>
                
            <div class="col-auto text-center justify-content-center pt-4 mx-4 mb-4 primary-buttons">
                <div class="figure align-middle">
                    <a class="align-content-center" type="image" href="">
                        <img src="assets/icons/borrow.png" height="100" width="100"/>
                    </a>
                    <p class="mt-3 mb-3 font-custom">Préstamos</p>
                </div>
            </div>
            <div href="" class="col-auto text-center justify-content-center pt-4 mx-4 mb-4 primary-buttons">
                <div class="figure align-middle">
                    <a class="align-content-center" type="image" href="">
                        <img src="assets/icons/history.png" height="100" width="100"/>
                    </a>
                    <p class="mt-3 mb-3 font-custom">Historial</p>
                </div>
            </div>
            <div class="col-auto text-center justify-content-center pt-4 mx-4 mb-4 primary-buttons">
                <div class="figure align-middle">
                    <a class="align-content-center" type="image" href="">
                        <img src="assets/icons/reports.png" height="100" width="100"/>
                    </a>
                    <p class="mt-3 mb-3 font-custom">Reportes</p>
                </div>
            </div>
            <div class="col-auto text-center justify-content-center pt-4 mx-4 mb-4 primary-buttons">
                <div class="figure align-middle">
                    <a class="align-content-center" type="image" href="">
                        <img src="assets/icons/logout.png" height="100" width="100"/>
                    </a>
                    <p class="mt-3 mb-3 font-custom">Salir</p>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="py-4 mt-5" style="background-color: #2A9D8F; font-family: Lato; font-size: large">
    <div class="container py-4 mx-auto px-auto ">
        <div class="row d-flex align-self-center" style="color: white">
            <div class="col-auto">
                <p style="font-weight: bold;">DEVUELVE.PE</p>
                <p>17 Princess Road Piura, Piura</p>
            </div>
            <div class="row">
                <div class="col-auto">
                    <p  style="font-weight: bold; text-align: end;">Empresa</p>
                </div>
                <div class="col-auto">
                    <p>Nosotros</p>
                    <p>Preguntas y respuetas frecuentes</p>
                </div>
            </div>
            <div class="row">
                <div class="col-auto">
                    <p  style="font-weight: bold; text-align: end;">Legal</p>
                </div>
                <div class="col-auto">
                    <p>Políticas de privacidad</p>
                    <p>Libro de reclamaciones</p>
                </div>
            </div>
        </div>
        <div class="row col-auto d-flex align-self-center" style="color: white">
            <p>©devuelve.pe - Todos los derechos reservados</p>
        </div>
    </div>
    </div>
</footer>

<!-- Optional JavaScript -->


<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>

<?php  
}else{
    header("Location:./login.php");
    exit;
}
?>


