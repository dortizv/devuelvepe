<div id="register">
    <h3>Registro</h3>

    <form action="lg-register.php" method = "POST">
        <label for="nombre">Nombre</label>
        <input  type = "text" name="nombre">
        <br>

        <label for="apellido">Apellido</label>
        <input  type = "text" name="apellido">
        <br>

        <label for="genero">Género</label>
        <input  type = "radio" name="genero" value = "masculino"> Masculino
        <input  type = "radio" name="genero" value = "femenino"> Femenino
        <br>

        <label for="tipodocumento">Tipo Documento</label>
        <input  type = "radio" name="tipodocumento" value = "dni"> DNI
        <input  type = "radio" name="tipodocumento" value = "carnetext"> Carnet Extranjería
        <br>

        <label for="numerodocumento">Número Documento</label>
        <input  type = "text" name="numerodocumento" maxlength="8">
        <br>

        <label for="distrito">Distrito</label>
        <input  type = "text" name="distrito">
        <br>

        <label for="provincia">Provincia</label>
        <input  type = "text" name="provincia">
        <br>

        <label for="departamento">Departamento</label>
        <input  type = "text" name="departamento">
        <br>

        <label for="direccion">Dirección</label>
        <input  type = "text" name="direccion">
        <br>

        <label for="telefono">Teléfono</label>
        <input  type = "text" name="telefono" maxlength="9">
        <br>

        <label for="email">E-mail</label>
        <input  type = "email" name="email">
        <br>

        <label for="username">Nombre de usuario</label>
        <input  type = "text" name="username">
        <br>

        <label for="pass">Contraseña</label>
        <input  type = "password" name="pass">
        <br>

        <button type="submit">Registrar</button>

    </form>
</div>










