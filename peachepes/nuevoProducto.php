<?php 
  session_start();
  //error_reporting(0);
  $varsession = $_SESSION['idUsuario'];
  
  if($varsession == null || $varsession = ''){
    echo 'No tienes autorización para entrar: agregar productos';
    die();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Productos</title>

	<link rel="stylesheet" href="\proyecto_cappfi\css\bootstrap.min.css">
	<link rel="stylesheet" href="\proyecto_cappfi\css\styles.css">
	<link rel="stylesheet" href="Proyecto_cappfi\mycss\stylesmines.css">
	<link rel="stylesheet" href="\prouemystyles.css">

	<!-- SweetAlert2 CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>
<body style="background-color: #00B545">

    <div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
		<div class="col-sm-6">
            <h1>Agregar productos</h1>
			<form action="" method="post" id="agregarProductoForm" enctype="multipart/form-data">

  				<?php 
					
					//verifica si se ha precionado "agregar"
					if(isset($_POST['btnAgregarProducto'])){
						//var_dump($_POST);	
						require "connected.php";

						// Obtiene los valores del formulario
						$nameProducto = $mysqli->real_escape_string($_POST['nombreProducto']);
						$priceProducto = $mysqli->real_escape_string($_POST['precioProducto']);
						$describeProducto = $mysqli->real_escape_string($_POST['descripcionProducto']);
						
						$imgProduct = $_FILES['imagenProductoF']['name'];	//obtiene el nombre
						$archivo = $_FILES['imagenProductoF']['tmp_name']; //obtiene el archivo
						$ruta = "../imagenesProductos";

						$ruta = $ruta."/".$imgProduct;

						move_uploaded_file($archivo, $ruta);
	
						$insertProducto = $mysqli->query("INSERT INTO productos(nombreProducto, precioProducto, descripcionProducto, imgProducto) VALUES('$nameProducto', '$priceProducto', '$describeProducto', '".$ruta."');");						
							
                        if($insertProducto){
							echo '
									<script>
									Swal.fire({
										icon: "success",
										title: "¡Producto agregado correctamente!",
									})
									</script>
								';
                        }
                        else{
                            echo "Ocurrió un error";
                        }

					}
				
				?>

				<div class="form-group">
					<label for="lbNombreProducto" class="labelsColor"><b>Nombre del producto<b></label>
					<input type="text" class="form-control" name="nombreProducto" id="nombreProducto" required>
				</div>
				<div class="form-group">
					<label for="lbPrecioProducto" class="labelsColor">Precio</label>
					<input type="number" class="form-control" name="precioProducto" id="PrecioProducto" required>
				</div>
				<div class="form-group">
					<label for="lbDescripcionProducto" class="labelsColor">Descripción:</label>
					<input type="text" class="form-control" name="descripcionProducto" id="descripcionProducto">
				</div>
				
                <div>
                    <label for="imagen">Imagen:</label>
					<input type="file" capture="environment" name="imagenProductoF" id="imagenProductoF" accept="image/*" required>
                </div>
                
                <button type="submit" class="btn btn-primary" style="margin-top: 5%;" name="btnAgregarProducto" id="btnAgregarProducto">Agregar</button>
                <button type="button" class="btn btn-danger" id="cancelarAgregarProducto" style="margin-top: 5%;" onclick="window.location.href = '/proyecto_cappfi/menuproductos.php';">Regresar</button>
			
                
            </form>
		</div>
	</div>

	<script src="scripts/codes.js"></script>
	
</body>
</html>