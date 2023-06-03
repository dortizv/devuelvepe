<?php
include_once("db.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {

//EXTRAER VALORES DEL REGISTER
    $pass = $_POST["pass"];
    $confirmpass = $_POST["confirmpass"];

    if($pass==$confirmpass){
        echo "Contraseñas coinciden";
    } else{
        echo "Confirmar contaseña";
    }
}
?>
