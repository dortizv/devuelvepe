<div id="Login">
    <h3>Login</h3>

    <form action="lg-login.php" method = "POST">
   
        <label for="username">Nombre de usuario</label>
        <input  type = "text" name="username">
        <br>

        <label for="pass">Contraseña</label>
        <input  type = "password" name="pass">
        <br>

        <button type="submit">Acceder</button>
        
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

        <p class="register"> ¿Eres un cliente nuevo?
            <a href="#">Regístrate</a>
        </p>
    </form>
</div>