<?php
// VALIDACIÓN DE USUARIO LOGUEADO
session_start();
if (isset($_SESSION['nombreUsuario']) && $_SESSION['idUsuario']){

    include_once("../login-val/db.php");

    $userId = $_SESSION['idUsuario'];

    $db = connect_db();

    $sql = "SELECT prestamo.idCliente, cliente.nombre, cliente.apellido, cliente.tipodocumento, cliente.documento 
            FROM cliente 
            INNER JOIN prestamo ON prestamo.idCliente = cliente.id
            INNER JOIN cobrador ON cobrador.id = prestamo.idCobrador
            WHERE cobrador.idUsuario = ?";


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
  <title>Listado de clientes</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1 class="mt-4">[logo] Clientes</h1>
    <h1 class="mt-4">Sección de íconos [icons]</h1>
    
    <table class="table">
      <thead class="thead-dark text-center">
        <tr>
          <th scope="col">Clientes</th>
          <th scope="col">Documento</th>
          <th scope="col">N° Documento</th>
          <th scope="col">Estado</th>
          <th scope="col">Botones</th>
        </tr>
      </thead>
      <tbody>

        <?php

        while ($row = $result -> fetch_assoc()){
        echo "<tr class='text-center'>";
        echo "<td>" . strtoupper($row['nombre']) .' '. strtoupper($row['apellido']) . "</td>";
        echo "<td>" . strtoupper($row['tipodocumento']) . "</td>";
        echo "<td>" . $row['documento'] . "</td>";
        echo "<td>Activo</td>"; //FALTA PONER LA LÓGICA PARA DETERMINAR SI ES ACTIVO O NO (Parece que se debe crear un campo en la tabla 'prestamo')
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