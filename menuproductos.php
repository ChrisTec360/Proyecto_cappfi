<?php 
  session_start();
  error_reporting(0);
  //$varsession = $_SESSION['correito'];
  $idUsuario = $_SESSION['idUsuario'];
  //require "connected.php";

  if($idUsuario == null || $idUsuario == ''){
    echo 'No tienes autorización para entrar';
    die();
  }

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Barra superior</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap.bundle.min.js/bootstrap.bundle.js">
	 <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
    

  <!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">

<!-- Tu archivo de estilos personalizado -->
<link rel="stylesheet" href="mycss/stylesmines.css">

<!-- SweetAlert2 JS -->
<!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>
  
    <!-- BARRA SUPERIOR -->
    <nav class="navbar fixed-top" style="background-color: #ff660e;" >

      <!-- DROPDOWN MENÚ DE OPCIONES-->
     <!--<h6>BIENVENIDO <?php echo $_SESSION['idUsuario'] ?> </h6> -->
        <div class="dropdown" style="padding-left: 5%;">
            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Menú
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" id="muestraproducto" href="menuproductos.php">Productos</a>
              <a class="dropdown-item" id="muestrapedidos" href="peachepes/pedidos.php">Pedidos</a>
              <a class="dropdown-item" id="muestracambiocontraseña" href="peachepes/cambiacontra.php">Cambiar contraseña</a>
              <li><hr class="dropdown-divider"></li>
              <a class="dropdown-item" href="cierrasesion.php">Cerrar sesión</a>              
            </div>
        </div>

        <!-- BUSCADOR no funciona aún
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="text" placeholder="Buscar" aria-label="Buscar">
          <button class="btn btn-outline-success" type="submit" style="color: white;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
          </button>
        </form>
-->
        <div>
          <a class="btn btn btn-primary" href="peachepes/nuevoProducto.php">Agregar productos</a>
        </div>

    </nav>
    
  <!-- PRODUCTOS -->
  <div class="container" id="contenedorProductos" style="padding-top: 15%;">
    <div class="row">
      <?php
      // Conexión a la base de datos
      require "peachepes/connected.php";
      

      // Obtener los productos de la base de datos
      $resultado = $mysqli->query("SELECT * FROM productos");

      // Recorrer los resultados y generar las cards
      
      while ($row = $resultado->fetch_assoc()) {
          $idProducto = $row['idProducto'];
          $idP = 'idProducto';
          $nombreProducto = $row['nombreProducto'];
          $precioProducto = $row['precioProducto'];
          $descripcionProducto = $row['descripcionProducto'];
          $imagenProducto = "imagenesProductos/" . $row['imgProducto'];

          
          // Generar la card con los datos del producto
          echo '<div class="col-md-4 mb-3">
                  <div class="card" style="width: 18rem;">
                    <img src="' . $imagenProducto . '" class="card-img-top" alt="' . $nombreProducto . '">
                    <div class="card-body">
                      <h5 class="card-title">' . $nombreProducto . '</h5>
                      <p class="card-text">Precio: ' . $precioProducto . '</p>
                      <p class="card-text">' . $descripcionProducto . '</p>
                      <button type="button "class="btn btn-primary btnEditarProductos" onClick="enviarIDEditar(' . $row['idProducto'] . ')">Editar</button>
                      <button type="button" class="btn btn-danger"          onClick="confirmarEliminarProducto(' . $row['idProducto'] . ')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                          <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                        </svg>
                      </button>
                    </div>
                  </div>
                </div>'; 
      }

      // Liberar memoria
      $resultado->free();

      // Cerrar conexión
      $mysqli->close();
      ?>
    </div>
  </div>

  <script src="scripts/eliminaProducto.js"></script>
  <script src="jotaQuery/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="scripts/menudesplegable.js"></script>
  <script src="scripts/editarProducto.js"></script>
  
</body>
</html>    