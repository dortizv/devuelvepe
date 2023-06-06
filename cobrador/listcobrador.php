<?php
// VALIDACIÓN DE USUARIO LOGUEADO
session_start();
if (isset($_SESSION['nombreUsuario']) && $_SESSION['idUsuario']){

    include_once("../login-val/db.php");

    $userId = $_SESSION['idUsuario'];

    $db = connect_db();

    $sql = "SELECT cobrador.idUsuario, cobrador.nombre, cobrador.apellido, cobrador.dni, COUNT(DISTINCT prestamo.id) AS cantidad_prestamos
                        FROM cobrador
                        LEFT JOIN prestamo ON cobrador.id = prestamo.idCobrador
                        WHERE cobrador.idUsuario = ?
                        GROUP BY cobrador.nombre";
                        

    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();


    //$row = $result -> fetch_assoc();
    //var_dump($row);
    //die();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Listado de cobradores</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1 class="mt-4">[logo] Cobradores</h1>
    <h1 class="mt-4">Sección de íconos [icons]</h1>
    
    <table class="table">
      <thead class="thead-dark text-center">
        <tr>
          <th scope="col">Colaborador</th>
          <th scope="col">DNI</th>
          <th scope="col">Clientes a cargo</th>
          <th scope="col">Clientes con deuda</th>
          <th scope="col">Botones</th>
        </tr>
      </thead>
      <tbody>
        
        <?php

        while ($row = $result -> fetch_assoc()){
        echo "<tr class='text-center'>";
        echo "<td>" . strtoupper($row['nombre']) .' '.strtoupper($row['apellido'])."</td>";
        echo "<td>" . $row['dni'] . "</td>";
        echo "<td>" . $row['cantidad_prestamos'] . "</td>";        
        echo "<td>" . $row['cantidad_prestamos'] . "</td>"; ; //FALTA PONER LA LÓGICA PARA DETERMINAR SI HAY CLIENTES MOROSOS (Parece que se debe crear un campo en la tabla 'prestamo')
        echo "</tr>";
        }

        ?>

      </tbody>
    </table>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>


<?php
//FIN DE VALIDACIÓN
}else{
    header("Location:./../login.php");
    exit;
}
?>