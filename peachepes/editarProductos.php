<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar producto</title>

    <link rel="stylesheet" href="/proyecto_cappfi/css/bootstrap.min.css">
	<link rel="stylesheet" href="/proyecto_cappfi/css/styles.css">
	<link rel="stylesheet" href="/proyecto_cappfi/mycss/stylesmines.css">
	<link rel="stylesheet" href="/prouemystyles.css">
    
    

</head>
<body>

    <div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
		<div class="col-sm-6">
            <h1>Editar productos</h1>
			<form action="" method="post" id="editarProductoForm" enctype="multipart/form-data">
                
  				<?php 
                    // Obtener el ID del producto de la URL
                    require "connected.php";
                    $editar = $_GET['idProducto'];
                    $consulta = "SELECT * FROM productos WHERE idProducto = $editar";      
                    
                    //Consulta a la base de datos para obtener los datos del producto por su ID
                    $resultado = $mysqli->query($consulta);
                    
                    // Verificar si se encontró el producto
                    if ($resultado->num_rows > 0) {
                        // Obtener los datos del producto y asignarlos a variables
                        $row = $resultado->fetch_assoc();
                        $nombreProductoDB = $row['nombreProducto'];
                        $precioProductoDB = $row['precioProducto'];
                        $descripcionProductoDB = $row['descripcionProducto'];
                        $imagenProductoDB = "../imagenesProductos/" . $row['imgProducto'];
                    } else {
                        // Si no se encontró el producto, mostrar un mensaje de error o redireccionar a otra página
                        echo "El producto no existe.";
                        exit();
                    }

                    // Liberar memoria del resultado de la consulta
                    $resultado->free();
				?>  
                 
                <!--Edición al precinar el botón--> 
                <?php 
					
					//verifica si se ha precionado "cambiar"
					if(isset($_POST['btnEditarProducto'])){
						
						require "connected.php";

						// Obtiene los valores del formulario
						$nuevoNombre = $mysqli->real_escape_string($_POST['editarNombreProducto']);
						$nuevaDescripcion = $mysqli->real_escape_string($_POST['editarDescripcionProducto']);
						$nuevoPrecio = $mysqli->real_escape_string($_POST['editarPrecioProducto']);
                        $actuProductos = $mysqli->query("UPDATE productos SET nombreProducto = '$nuevoNombre', descripcionProducto = '$nuevaDescripcion', precioProducto = '$nuevoPrecio' WHERE idProducto = $editar");

                        if($actuProductos){
                            header("Location: ../menuproductos.php");
                            exit();
                        }
                        else{
                            echo "Ha ocurrido un error";
                        }



					}
				
				?>

                <!--Edición al precinar el botón--> 
                    

				<div class="form-group">
					<label for="lbNombreProducto" class="labelsColor">Nombre del producto</label>
					<input type="text" class="form-control" name="editarNombreProducto" id="editarNombreProducto" value="<?php echo $nombreProductoDB; ?>">
				</div>
				<div class="form-group">
					<label for="lbPrecioProducto" class="labelsColor">Precio</label>
					<input type="number" class="form-control" name="editarPrecioProducto" id="editarPrecioProducto" value="<?php echo $precioProductoDB; ?>">
				</div>
				<div class="form-group">
					<label for="lbDescripcionProducto" class="labelsColor">Descripción:</label>
					<input type="text" class="form-control" name="editarDescripcionProducto" id="editarDescripcionProducto" value="<?php echo $descripcionProductoDB; ?>">
				</div>
				
                

                <div>
                    <img src="<?php echo $imagenProductoDB; ?>" alt="<?php echo $nombreProductoDB; ?>" height="150px" weight="auto">
                    <input type="file" class="form-control-file" id="editarImagenProducto" name="editarImagenProductoF">
                </div>

                
                <button type="submit" class="btn btn-primary" style="margin-top: 5%;" name="btnEditarProducto" id="btnEditarProducto">Editar</button>
                <button type="button" class="btn btn-danger" id="cancelarEditarProducto" style="margin-top: 5%;" onclick="window.location.href = '/proyecto_cappfi/menuproductos.php';">Regresar</button>
			</form>
		</div>
	</div>

</body>
</html>
