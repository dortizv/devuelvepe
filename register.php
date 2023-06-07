<!doctype html>
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

    <link href="assets/css/register_style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="./assets/css/style.css" rel="stylesheet">



</head>

<body class="my-5 contact h-100" style="min-width: 460px">
    <div style="background-color: #2A9D8F; color: white;" class="container-fluid align-content-center justify-content-center px-4 php-email-form m-auto" id="container-sign-up">
        <div class="section-title">
            <h2 class="text-white text-center pt-4">Crear una cuenta</h2>
        </div>
        <form class="col" action="register-val/lg-register.php" method = "POST">
            <div class="row form-group mb-0">
                <div class="col-md-6 mb-3">
                    <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
                </div>
                <div class="col-md-6 mb-3">
                    <input type="text" class="form-control" name="apellido" placeholder="Apellido" required>
                </div>
            </div>

            <div class="row align-content-center justify-content-center">
                <div class="col-md-4 col-sm-12 mb-3 m-auto justify-content-center">
                    <input type="text" class="form-control" name="numerodocumento" placeholder="Documento de identidad"  required>
                </div>

                <div class="col-md-4 col-sm-12 mb-3 m-auto">
                    <label class="row mb-0 mx-auto">Tipo de documento</label>
                    <div class="form-check custom-radio px-0">
                        <input type="radio" name="tipodocumento" value="dni" id="dni" required> DNI
                        <input type="radio" name="tipodocumento" value="carnetext" id="carnetext" required> Carnet Extranjería
                    </div>
                </div>

                <div class="col-md-4 col-sm-12 mb-3 m-auto">
                    <label class="mb-0 mx-auto">Sexo</label>
                    <div class="form-check custom-radio px-0">
                        <input  type = "radio" name="genero" value = "masculino" id="masculino" required> Masculino
                        <input  type = "radio" name="genero" value = "femenino" id="femenino" required> Femenino
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <input type="text" class="form-control" name="distrito" placeholder="Distrito" required>
                </div>
                <div class="col-md-4 mb-3">
                    <input type="text" class="form-control" name="provincia" placeholder="Provincia" required>
                </div>
                <div class="col-md-4 mb-3">
                    <input type="text" class="form-control" name="departamento" placeholder="Departamento" required>
                </div>
            </div>

            <div class="row form-group mb-0">
                <div class="col-md-6 mb-3">
                    <input type="text" class="form-control" name="direccion" placeholder="Dirección" required>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="telefono" placeholder="Teléfono" pattern="^[0-9]{9}$" required>
                </div>
            </div>

            <hr class="my-3">

            <div class="row form-group mb-0">
                <div class="col-md-6 my-3">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
                <div class="col-md-6 my-3">
                    <input type="text" class="form-control" name="username" placeholder="Nuevo usuario" required>
                </div>
            </div>

            <div class="row form-group mb-0">
                <div class="col-md-6 mb-3">
                    <input type="password" class="form-control" name="pass" placeholder="Contraseña" required>
                </div>
                <div class="col-md-6 mb-3">
                    <input type="password" class="form-control" name="confirmpass" placeholder="Confirmar contraseña" required>
                </div>
            </div>

            <hr class="mb-4">


            <div class="row">
                <div class="custom-control custom-checkbox mx-3 mb-3">
                    <input type="checkbox" class="custom-control-input" id="accept-term" required> Aceptar las <a href="">Condiciones de servicio</a> y la <a href="">Política de privacidad</a> de Devuelve.pe</label>
                </div>
            </div>

            <div class="row justify-content-center pb-4">
                <button class="mx-3" style="width: fit-content" type="submit">Registrarse</button>
                <button class="mx-3" style="background-color: lightgray; width: fit-content" type="submit" formaction="login.php" formnovalidate>Cancelar</button>
            </div>

        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>