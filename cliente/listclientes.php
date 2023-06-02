<?php
// VALIDACIÓN DE USUARIO LOGUEADO
session_start();
if (isset($_SESSION['nombreUsuario']) && $_SESSION['idUsuario']){

    include_once("../login-val/db.php");

    $userId = $_SESSION['idUsuario'];

    $db = connect_db();

    $sql = "SELECT prestamo.idCliente, cliente.nombre, cliente.apellido, prestamo.monto, prestamo.cuotas, prestamo.tasa, prestamo.fecha 
            FROM prestamo 
            INNER JOIN cobrador ON cobrador.id = prestamo.idCobrador
            INNER JOIN usuario ON usuario.id=cobrador.id 
            INNER JOIN cliente ON prestamo.idCliente = cliente.id 
            WHERE usuario.id = ?";


    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    //
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
          <th scope="col">Cuotas</th>
          <th scope="col">Deuda Total</th>
          <th scope="col">Próximo pago</th>
          <th scope="col">Tasa (%)</th>
          <th scope="col">Botones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($row = $result -> fetch_assoc()){
        echo "<tr class='text-center'>";
        echo "<td>" . $row['nombre'] .' '.$row['apellido']."</td>";
        echo "<td>" . $row['cuotas'] . "</td>";
        echo "<td>" . $row['monto'] . "</td>";
        echo "<td>" . $row['fecha'] . "</td>";
        echo "<td>" . $row['tasa'] . "</td>";
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