<html>
<head>
  <!-- Incluye los archivos JavaScript y CSS de SweetAlert2 y jQuery -->
  <!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>-->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  

</head>
<body>

  <?php
    //Realiza la conexión a la base de datos y otras configuraciones necesarias
    //Conectar a la base de datos
    //Datos de conexión a la base de datos
    $servername = '127.0.0.1:3308';
    $username = 'nuevo_usuario';
    $password = 'contraseña_segura';
    $dbname = 'proyectocappfy';
      
    $conexion = mysqli_connect($servername, $username, $password, $dbname);

    $eliminar = $_POST['idd'];
    $consulta = "DELETE FROM productos WHERE idProducto='$eliminar'";

    if (mysqli_query($conexion, $consulta) === TRUE) {
      echo json_encode(["success" => true, "message" => "Producto eliminado exitosamente"]);
    } else {
      echo json_encode(["success" => false, "message" => "Error al eliminar el producto"]);
    }


  ?>

<script src="../jotaQuery/jquery-3.7.0.min.js"></script>
</body>
</html>