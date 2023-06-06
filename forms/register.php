<div id="register">
    <h3>Registro</h3>

    <form action="lg-register.php" method = "POST">
        <label for="nombre">Nombre</label>
        <input  type = "text" name="nombre" id="nombre" required>
        <br>

        <label for="apellido">Apellido</label>
        <input  type = "text" name="apellido" id="apellido" required>
        <br>

        <label>Género</label>
        <input  type = "radio" name="genero" value = "masculino" id="masculino"> Masculino
        <input  type = "radio" name="genero" value = "femenino" id="femenino"> Femenino
        <br>

        <label for=>Tipo Documento</label>
        <input  type = "radio" name="tipodocumento" value = "dni" id="dni"> DNI
        <input  type = "radio" name="tipodocumento" value = "carnetext" id="carnetext"> Carnet Extranjería
        <br>

        <label for="numerodocumento">Número Documento</label>
        <input  type = "text" name="numerodocumento" id="numerodocumento" pattern="^[0-9]{8}$" required>
        <br>

        <label for="distrito">Distrito</label>
        <input  type = "text" name="distrito" id="distrito">
        <br>

        <label for="provincia">Provincia</label>
        <input  type = "text" name="provincia" id="provincia">
        <br>

        <label for="departamento">Departamento</label>
        <input  type = "text" name="departamento" id="departamento">
        <br>

        <label for="direccion">Dirección</label>
        <input  type = "text" name="direccion" id="direccion">
        <br>

        <label for="telefono">Teléfono</label>
        <input  type = "text" name="telefono" pattern="^[0-9]{9}$" id= "telefono" required>
        <br>

        <label for="email">E-mail</label>
        <input  type = "email" name="email" id="email" required>
        <br>

        <label for="username">Nombre de usuario</label>
        <input  type = "text" name="username" id="username" required>
        <br>

        <label for="pass">Contraseña</label>
        <input  type = "password" name="pass" id="pass" required>
        <br>

        <button type="submit">Registrar</button>

    </form>
</div>










