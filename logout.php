<?php
session_start();

// Destruir la sesión
session_destroy();

// Redireccionar a la página de inicio de sesión (login.php)
header("Location: login.php");
exit;
?>