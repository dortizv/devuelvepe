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

</head>

<body style="background-color: #FBF4EE">
<?php
session_start();

// Verificar si hay un mensaje de error en la variable de sesión
if (isset($_SESSION['error_message'])) {
    // Mostrar el mensaje de error
    echo $_SESSION['error_message'];

    // Limpiar el mensaje de error de la variable de sesión
    unset($_SESSION['error_message']);
}
?>

<main class="container-fluid vh-100" style="min-width: 30%; min-height: 30%;">
    <div class="d-flex text-center justify-content-center align-items-center h-100">
        <div style="background-color: #2A9D8F; min-width: 360px; max-width: 400px; height: 420px; margin: auto 5% auto 5%; padding: 30px;"  class="col contact rounded-5 text-center justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
            <svg style="max-width: 300px;" class="row px-0 my-auto mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 3184.98 785.53"><defs><style>.cls-1{fill:url(#linear-gradient);}.cls-2{fill:url(#linear-gradient-12);}.cls-3{fill:#fff;}</style><linearGradient id="linear-gradient" x1="1355.94" y1="-354.76" x2="1721.97" y2="969.05" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#f4a361"/><stop offset="0.48" stop-color="#f0af63"/><stop offset="1" stop-color="#e9c266"/></linearGradient><linearGradient id="linear-gradient-12" x1="251.45" y1="-45.1" x2="471.11" y2="749.34" xlink:href="#linear-gradient"/></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_16" data-name="Layer 16"><path class="cls-1" d="M106.17,385.26l101.9-95.79L311.8,368.18v-166c94.26,1.85,250.27-25.84,249,151.94-2.29,146.53-126,143.58-241.63,143.38v-83L0,601.57l318.51,184V706.82C468.29,723,706.78,673.19,763.32,446c20.4-65.3,11.86-219.11-34.58-280.76C606.71-42.57,303.11,6.68,104.75,1.87Z"/><path class="cls-1" d="M920.31,440.48c2.18,40.35,25.08,66.53,60,66.53,22.91,0,43.08-11.45,48-30h73.07c-16.35,55.07-60.53,86.16-117.78,86.16-89.44,0-134.15-49.08-134.15-146.15,0-82.89,47.44-136.33,129.78-136.33s126,53.44,126,159.78Zm111.79-44.72C1031,356,1004.83,336.87,977,336.87c-28.35,0-51.8,21.81-54.53,58.89Z"/><path class="cls-1" d="M1194.6,556.09l-96-268.3h79.07L1233.86,465l56.71-177.23h74.71l-96.52,268.3Z"/><path class="cls-1" d="M1558.86,556.09V518.46c-18.54,30.54-46.35,44.72-83.43,44.72-53.44,0-91.07-39.81-91.07-98.71V287.79h70.89V453.57c0,33.81,15.27,50.17,45.26,50.17,36,0,55.08-25.63,55.08-61.08V287.79h70.35v268.3Z"/><path class="cls-1" d="M1721.91,440.48c2.18,40.35,25.09,66.53,60,66.53,22.9,0,43.08-11.45,48-30H1903c-16.36,55.07-60.53,86.16-117.79,86.16C1695.74,563.18,1651,514.1,1651,417c0-82.89,47.44-136.33,129.79-136.33s126,53.44,126,159.78Zm111.79-44.72c-1.09-39.8-27.26-58.89-55.08-58.89-28.35,0-51.8,21.81-54.53,58.89Z"/><path class="cls-1" d="M1931.31,556.09V189.63h70.89V556.09Z"/><path class="cls-1" d="M2115.62,556.09l-96-268.3h79.08L2154.88,465l56.72-177.23h74.71l-96.53,268.3Z"/><path class="cls-1" d="M2351.74,440.48c2.18,40.35,25.08,66.53,60,66.53,22.91,0,43.08-11.45,48-30h73.08c-16.36,55.07-60.54,86.16-117.79,86.16-89.44,0-134.15-49.08-134.15-146.15,0-82.89,47.44-136.33,129.78-136.33s126,53.44,126,159.78Zm111.79-44.72c-1.09-39.8-27.27-58.89-55.08-58.89-28.35,0-51.8,21.81-54.53,58.89Z"/><path class="cls-1" d="M2546.42,556.09V482.47h75.8v73.62Z"/><path class="cls-1" d="M2650,683.15V287.79h68.17l.54,32.72c16.91-27.27,42-39.81,74.71-39.81,67.62,0,116.16,53.44,116.16,144,0,81.25-40.9,138.51-110.16,138.51-33.26,0-59.44-13.64-79.61-42v162Zm187.59-263.39c0-48-25.08-81.25-60.53-81.25-33.81,0-60,31.62-60,76.89,0,58.34,20.18,87.25,59.44,87.25C2818,502.65,2837.61,474.84,2837.61,419.76Z"/><path class="cls-1" d="M3000.11,440.48c2.18,40.35,25.09,66.53,60,66.53,22.9,0,43.08-11.45,48-30h73.07c-16.36,55.07-60.53,86.16-117.79,86.16-89.43,0-134.15-49.08-134.15-146.15,0-82.89,47.44-136.33,129.79-136.33s126,53.44,126,159.78Zm111.79-44.72c-1.09-39.8-27.26-58.89-55.07-58.89-28.36,0-51.81,21.81-54.54,58.89Z"/><path class="cls-2" d="M106.17,385.26l101.9-95.79L311.8,368.18v-166c94.26,1.85,250.27-25.84,249,151.94-2.29,146.53-126,143.58-241.63,143.38v-83L0,601.57l318.51,184V706.82C468.29,723,706.78,673.19,763.32,446c20.4-65.3,11.86-219.11-34.58-280.76C606.71-42.57,303.11,6.68,104.75,1.87Z"/><path class="cls-3" d="M920.31,440.48c2.18,40.35,25.08,66.53,60,66.53,22.91,0,43.08-11.45,48-30h73.07c-16.35,55.07-60.53,86.16-117.78,86.16-89.44,0-134.15-49.08-134.15-146.15,0-82.89,47.44-136.33,129.78-136.33s126,53.44,126,159.78Zm111.79-44.72C1031,356,1004.83,336.87,977,336.87c-28.35,0-51.8,21.81-54.53,58.89Z"/><path class="cls-3" d="M1194.6,556.09l-96-268.3h79.07L1233.86,465l56.71-177.23h74.71l-96.52,268.3Z"/><path class="cls-3" d="M1558.86,556.09V518.46c-18.54,30.54-46.35,44.72-83.43,44.72-53.44,0-91.07-39.81-91.07-98.71V287.79h70.89V453.57c0,33.81,15.27,50.17,45.26,50.17,36,0,55.08-25.63,55.08-61.08V287.79h70.35v268.3Z"/><path class="cls-3" d="M1721.91,440.48c2.18,40.35,25.09,66.53,60,66.53,22.9,0,43.08-11.45,48-30H1903c-16.36,55.07-60.53,86.16-117.79,86.16C1695.74,563.18,1651,514.1,1651,417c0-82.89,47.44-136.33,129.79-136.33s126,53.44,126,159.78Zm111.79-44.72c-1.09-39.8-27.26-58.89-55.08-58.89-28.35,0-51.8,21.81-54.53,58.89Z"/><path class="cls-3" d="M1931.31,556.09V189.63h70.89V556.09Z"/><path class="cls-3" d="M2115.62,556.09l-96-268.3h79.08L2154.88,465l56.72-177.23h74.71l-96.53,268.3Z"/><path class="cls-3" d="M2351.74,440.48c2.18,40.35,25.08,66.53,60,66.53,22.91,0,43.08-11.45,48-30h73.08c-16.36,55.07-60.54,86.16-117.79,86.16-89.44,0-134.15-49.08-134.15-146.15,0-82.89,47.44-136.33,129.78-136.33s126,53.44,126,159.78Zm111.79-44.72c-1.09-39.8-27.27-58.89-55.08-58.89-28.35,0-51.8,21.81-54.53,58.89Z"/><path class="cls-3" d="M2546.42,556.09V482.47h75.8v73.62Z"/><path class="cls-3" d="M2650,683.15V287.79h68.17l.54,32.72c16.91-27.27,42-39.81,74.71-39.81,67.62,0,116.16,53.44,116.16,144,0,81.25-40.9,138.51-110.16,138.51-33.26,0-59.44-13.64-79.61-42v162Zm187.59-263.39c0-48-25.08-81.25-60.53-81.25-33.81,0-60,31.62-60,76.89,0,58.34,20.18,87.25,59.44,87.25C2818,502.65,2837.61,474.84,2837.61,419.76Z"/><path class="cls-3" d="M3000.11,440.48c2.18,40.35,25.09,66.53,60,66.53,22.9,0,43.08-11.45,48-30h73.07c-16.36,55.07-60.53,86.16-117.79,86.16-89.43,0-134.15-49.08-134.15-146.15,0-82.89,47.44-136.33,129.79-136.33s126,53.44,126,159.78Zm111.79-44.72c-1.09-39.8-27.26-58.89-55.07-58.89-28.36,0-51.81,21.81-54.54,58.89Z"/></g></g></svg>
            <div style="max-width: 300px;" class="row px-0 mx-auto pb-0 section-title aos-init aos-animate" data-aos="fade-up">
                <h2 class="px-0 text-white py-4" style="font-size: 20px">Iniciar Sesión</h2>
            </div>
            <form style="max-width: 300px" class="justify-content-center row mx-auto  px-0 php-email-form" action="./login-val/lg-login.php" method="POST">
                <div class="row form-group">
                    <input type="text" name="username" class="form-control" placeholder="Usuario">
                </div>
                <div class="row form-group">
                    <input type="password" name="pass" class="form-control" placeholder="Contraseña">
                </div>
                <button class="mb-3" style="max-width: 14vmax; min-width: 120px;" type="submit">Acceder</button>
            </form>

            <div class="my-auto text-white">
                ¿Eres un cliente nuevo?
                <a href="./register.php" class="text-center" style="color:#FFCC66; font-weight: bold">Regístrate</a>
            </div>
            
        </div>
    </div>


</main>

<!-- Vendor JS Files -->
<script src="./assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="./assets/vendor/aos/aos.js"></script>
<script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="./assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="./assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="./assets/vendor/swiper/swiper-bundle.min.js"></script>
<!--<script src="./assets/vendor/php-email-form/validate.js"></script>-->

<!-- Template Main JS File -->
<script src="./assets/js/main.js"></script>

</body>
</html>