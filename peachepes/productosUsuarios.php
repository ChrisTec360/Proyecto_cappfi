<?php
session_start();
error_reporting(0);
$idUsuario = $_SESSION['idUsuario'];
$nameser = $_SESSION['nombreUsuario'];
require "connected.php";

if ($idUsuario == null || $idUsuario == '') {
  echo 'No tienes autorización para entrar: logueate o crea una cuenta';
  die();
}

if (isset($_POST['alcarrito'])) {

  if (isset($_SESSION['cart'])) {
    $session_array_id = array_column($_SESSION['cart'], "idProducto");

    if (!in_array($_GET['idProducto'], $session_array_id)) {
      $session_array = array(
        'idProducto' => $_GET['idProducto'],
        'nombreProducto' => $_POST['nombreProducto'],
        'precioProducto' => $_POST['precioProducto'],
        'imagenProducto' => $_POST['imagenProducto']
      );

      $_SESSION['cart'][] = $session_array;

    }

  } else {

    $session_array = array(
      'idProducto' => $_GET['idProducto'],
      'nombreProducto' => $_POST['nombreProducto'],
      'precioProducto' => $_POST['precioProducto'],
      'imagenProducto' => $_POST['imagenProducto']
    );

    $_SESSION['cart'][] = $session_array;

  }

}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barra superior</title>
  <link rel="stylesheet" href="/proyecto_cappfi/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap.bundle.min.js/bootstrap.bundle.js">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>

  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">

  <!-- Tu archivo de estilos personalizado -->
  <link rel="stylesheet" href="mycss/stylesmines.css">

  <!-- SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

<h6>BIENVENIDO</h6>


<!--
  <h6> BIENVENIDO
    mostrar nombre del usuario (aun en pruebas)
    <?php 
    session_start();
    $namedeluser = $_SESSION['nombreUsuario'];
    echo $namedeluser?>
    */
  </h6>
-->
  <!-- BARRA SUPERIOR -->
  <nav class="navbar fixed-top" style="background-color: #ff660e;">

    <!-- DROPDOWN MENÚ DE OPCIONES-->
    <div class="dropdown" style="padding-left: 5%;">
      <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Menú
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" id="muestraproducto" href="productosUsuarios.php">Productos</a>
        <a class="dropdown-item" id="muestrapedidos" href="pedidosUsuarios.php">Pedidos</a>
        <a class="dropdown-item" id="muestracambiocontraseña" href="cambiacontra.php">Cambiar contraseña</a>
        <li>
          <hr class="dropdown-divider">
        </li>
        <a class="dropdown-item" href="../cierrasesion.php">Cerrar sesión</a>
      </div>
    </div>

    <!-- CARRITO -->
    <div class="ml-auto d-flex align-items-center justify-content-center" style="padding-right: 5%;">
      <button class="d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fa fa-shopping-cart mr-2"></i>
        <div class="iconocarrito" type="button">
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-cart4"
            viewBox="0 0 16 16">
            <path
              d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" />
          </svg>
        </div>
      </button>
    </div>

    <!-- BUSCADOR (AUN EN PRUEBAS)
    <form class="d-flex" role="search">
      <input class="form-control me-2" type="text" placeholder="Buscar" aria-label="Buscar">
      <button class="btn btn-outline-success" type="submit" style="color: white;">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
          viewBox="0 0 16 16">
          <path
            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
        </svg>
      </button>
    </form>
    -->

  </nav>
  <!-- TERMINA NAV -->

  <!-- INICIA MODAL -->
  <form action="insertarPedido.php" method="post">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">TU PEDIDO</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <div class="col-md-6">

              <?php

              $output = "";

              $output .= "            
                <table class='table table-bordered table-striped'>
                  <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Precio Total</th>
                    <th>Eliminar</th>
                  </tr>
                ";

              if (!empty($_SESSION['cart'])) {

                foreach ($_SESSION['cart'] as $key => $value) {
                  $output .= "
                    <tr>
                      <td>" . $value['idProducto'] . "</td>
                      <td>" . $value['nombreProducto'] . "</td>
                      <td>" . $value['precioProducto'] . "</td>
                      <td>
                        <label id='cantidadProduct" . $value['idProducto'] . "'>1</label>
                        <input type='hidden' name=\"cantidadInput[" . $value['idProducto'] . "]\" id=\"cantidadInput" . $value['idProducto'] . "\" value=\"1\">
                        <button type='button' class='btn btn-danger' onclick=\"decrementarCantidad(" . $value['idProducto'] . ")\">-</button>
                        <button type='button' class='btn btn-success' onclick=\"incrementarCantidad(" . $value['idProducto'] . ")\">+</button>
                      </td>
                      <td>
                        <label id='subtotalProduct" . $value['idProducto'] . "' data-precio='" . $value['precioProducto'] . "'>" . $value['precioProducto'] * 1.00 . "</label>
                      </td>
                      <td>
                        <div type='container'>                           
                          <a href='productosUsuarios.php?action=remove&idProducto=" . $value['idProducto'] . "' class='btn btn-danger btn-block'>Quitar</a>
                        </div>
                      </td>
                    </tr>
                    ";

                }

                // Calcular el total del pedido
                $totalPedidos = 0;
                foreach ($_SESSION['cart'] as $value) {
                  $totalPedidos += $value['precioProducto'];
                }

                $output .= "     
                  <tr>
                    <td colspan='3'></td>
                    <td><b>TOTAL</b></td>
                    <td>  
                      <label id='totalPedidoLabel' name='totalPedidoLabel'>" . $totalPedidos . "</label>                                       
                    </td>
                    <td>     
                      <a href='productosUsuarios.php?action=clearall&idProducto' class='btn btn-danger btn-block'>Limpiar</a>
                    </td>          
                  </tr>
                  ";

              }

              $output .= "</table>";

              echo $output;
              ?>
            </div> <!--colum-->
          </div><!--modal body-->

          <div class="modal-footer">
            <input type="hidden" name="totalPedidoInput" id="totalPedidoInput" value="<?php echo $totalPedidos; ?>">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" name="btnPedir">Realizar pedido</button>
          </div>

        </div><!--modal content-->
      </div><!--modal dialog-->
    </div><!--modal fade-->
  </form>

  <!-- Termina el modal -->

  <!-- PRODUCTOS -->
  <div style="padding-top: 3%;"></div>
  <h6> BIENVENIDO
    <?php echo $_SESSION['nombreUser'] ?>
  </h6>

  <div class="container" id="contenedorProductos" style="padding-top: 2%;">
    <div class="row">
      <?php
      // Conexión a la base de datos
      require "connected.php";

      // Obtener los productos de la base de datos
      $resultado = $mysqli->query("SELECT * FROM productos");

      // Recorrer los resultados y generar las cards
      while ($row = $resultado->fetch_assoc()) {
        $idProducto = $row['idProducto'];
        $nombreProducto = $row['nombreProducto'];
        $precioProducto = $row['precioProducto'];
        $descripcionProducto = $row['descripcionProducto'];
        $imagenProducto = "../imagenesProductos/" . $row['imgProducto'];

        // Generar la card con los datos del producto
        echo '
            <div class=col-md-4>
              <form method="post" action="productosUsuarios.php?idProducto=' . $row['idProducto'] . '">

                <div class="col-md-4 mb-3">                
                  <div class="card" style="width: 18rem;">
                    <img src="' . $imagenProducto . '" class="card-img-top" alt="' . $nombreProducto . '">
                    <div class="card-body">
                      <h5 class="card-title">' . $nombreProducto . '</h5>
                      <p class="card-text">Precio: ' . $precioProducto . '</p>
                      <p class="card-text">' . $descripcionProducto . '</p>

                      <input type="hidden" name="idProducto" value="' . $idProducto . '">
                      <input type="hidden" name="imagenProducto" value="' . $imagenProducto . '">
                      <input type="hidden" name="nombreProducto" value="' . $nombreProducto . '">
                      <input type="hidden" name="precioProducto" value="' . $precioProducto . '">

                      <input type="submit" name="alcarrito" class="btn btn-warning" value="Agregar al pedido">                      
                    </div>
                  </div>        
                </div>
              </form>
            </div>';

      } //termina while
      
      // Liberar memoria
      $resultado->free();

      // Cerrar conexión
      $mysqli->close();
      ?>
    </div>
  </div>

  <?php
    if (isset($_GET['action'])) {

      if ($_GET['action'] == "clearall") {
        unset($_SESSION['cart']);
      }

      if ($_GET['action'] == "remove") {
        foreach ($_SESSION['cart'] as $key => $value) {

          if ($value['idProducto'] == $_GET['idProducto']) {

            header("Location: productosUsuarios.php");
            unset($_SESSION['cart'][$key]);
            exit;
          }

        }

      }

    }

  ?>


  <script src="scripts/menudesplegable.js"></script>
  <script src="scripts/cart.js"></script>
  <script src="../scripts/cart.js"></script>
  <script src="../scripts/cantProductos.js"></script>

</body>

</html>