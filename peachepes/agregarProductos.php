<?php
      // Conectar a la base de datos
      // Datos de conexión a la base de datos
      $servername = '127.0.0.1:3308';
      $username = 'nuevo_usuario';
      $password = 'contraseña_segura';
      $dbname = 'proyectocappfy';
      
      $conexion = mysqli_connect($servername, $username, $password, $dbname);
      
      // Verificar si hay errores en la conexión
      if (!$conexion) {
          die("Error al conectar a la base de datos: " . mysqli_connect_error());
      }
      
      // Consultar los productos de la base de datos
      $resultado = mysqli_query($conexion, "SELECT * FROM productos");
      
      // Recorrer los resultados de la consulta y mostrar los productos en las cards
      while ($fila = mysqli_fetch_assoc($resultado)) {
          echo '<div class="col-md-4 mb-3">
                  <div class="card">
                    <img src="' . $fila['imagen_producto'] . '" class="card-img-top square-image" alt="' . $fila['nombreProducto'] . '">
                    <div class="card-body">
                      <h5 class="card-title">' . $fila['nombreProducto'] . '</h5>
                      <p class="card-text">Precio: $' . $fila['precioProducto'] . '</p>
                      <a href="#" class="btn btn-primary" onclick="agregarAlCarrito(' . $fila['idProducto'] . ')">Agregar al pedido</a>
                    </div>
                  </div>
                </div>';
      }
      
      // Cerrar la conexión a la base de datos
      mysqli_close($conexion);
      ?>


<!--
<div class="container" id="contenedorProductos" style="padding-top: 2%;">
        <div class="row"> 

          <div class="col-md-4 mb-3">
            <div class="card">
              <img src="imgs/imgEmperadorSenzo.png" class="card-img-top square-image" alt="...">
              <div class="card-body">
              <h5 class="card-title">Emperador senzo</h5>
                <p class="card-text">Descripción del producto</p>
                <p class="card-text">Precio: $18</p>
                <a href="#" class="btn btn-primary">Agregar al pedido</a>
              </div>
            </div>
          </div>
          
          

          <div class="col-md-4 mb-3">
            <div class="card">
              <img src="imgs/imgTacosSuadero.png" class="card-img-top square-image" alt="...">
              <div class="card-body">
                <h5 class="card-title">Tacos de suadero</h5>
                <p class="card-text">Descripción del producto</p>
                <p class="card-text">Precio: $40 x 5 tacos</p>
                <a href="#" class="btn btn-primary">Agregar al pedido</a>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-3">
            <div class="card">
              <img src="imgs/imgCoca600.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Coca-cola 600 ml</h5>
                <p class="card-text">Descripción del producto 3.</p>
                <p class="card-text">Precio: $18</p>
                <a href="#" class="btn btn-primary">Agregar al pedido</a>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-3">
            <div class="card">
              <img src="imgs/imgPicadas.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Picadas</h5>
                <p class="card-text">Descripción del producto</p>
                <p class="card-text">Precio: $8 c/u</p>
                <a href="#" class="btn btn-primary">Agregar al pedido</a>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-3">
            <div class="card">
              <img src="imgs/imgSabritas.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Sabritas clásicas</h5>
                <p class="card-text">Descripción del producto</p>
                <p class="card-text">Precio: $15</p>
                <a href="#" class="btn btn-primary">Agregar a pedido</a>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-3">
            <div class="card">
              <img src="imgs/imgJugoValleMango413.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Jugo del valle 413 ml</h5>
                <p class="card-text">Descripción del producto</p>
                <p class="card-text">Precio: $18</p>
                <a href="#" class="btn btn-primary">Agregar al carrito</a>
              </div>
            </div>
          </div>
        
        
        
        
        </div>
      </div>




