<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Crear cuenta</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="mystyles.css">

	<!-- Incluye los estilos de Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<!-- Incluye el script de Bootstrap -->
	<script src="/js/bootstrap.min.js"></script>

	<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


</head>

<body style="background-color: rgb(81, 175, 252);">


	<!--php-->
	<?php
	// Datos de conexión a la base de datos
	$servername = '127.0.0.1:3308';
	$username = 'nuevo_usuario';
	$password = 'contraseña_segura';
	$dbname = 'proyectocappfy';

	// Crear conexión a la base de datos
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	/*$conn -> set_charset("utf8");*/
	mysqli_set_charset($conn, "UTF8mb4");

	// Verificar si la conexión es exitosa
	if (!$conn) {
		die("Conexión fallida: " . mysqli_connect_error());
	}
	
	if (isset($_POST['btnRegister'])) {

		// Obtener los datos ingresados en el formulario
		$nombre = $_POST["nombre"];
		$nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
		$email = $_POST["correo"];
		$email = mysqli_real_escape_string($conn, $_POST["correo"]);
		$password = $_POST["contraseña"];
		$password = mysqli_real_escape_string($conn, $_POST["contraseña"]);
		$allowedDomain = '@cuautla.tecnm.mx'; //para que solo puedan registrarse usuarios del tec cuautla
		$confirmarPassword = mysqli_real_escape_string($conn, $_POST["confirmar-contraseña"]);
		
		if (strpos($email, $allowedDomain) === false) {
			// El correo electrónico no pertenece al tecnm cuautla
			echo '
				<script>
				Swal.fire({
					icon: "error",
					title: "Oops...",
					text: "Sólo se permiten correos del TecNM campus Cuautla: control@cuautla.tecnm.mx"
				})
				</script>
			';
			// mostrar un mensaje de error al usuario o redirigirlo a una página de error de registro.
		} elseif ($password !== $confirmarPassword) {
			// Las contraseñas no coinciden
			echo '
				<script>
				Swal.fire({
					icon: "error",
					title: "Oops...",
					text: "Las contraseñas no coinciden"
				})
				</script>
			';


		} else {

			// Crear la consulta SQL para insertar los datos en la base de datos
			$sql = "INSERT INTO usuarios (nombreUsuario, correoUsuario, contrasenaUsuario) VALUES ('$nombre', '$email', '$password')";

			// Ejecutar la consulta SQL
			if ($conn->query($sql) === TRUE) {
				echo "Registro creado exitosamente";
				// Cerrar la conexión a la base de datos
				mysqli_close($conn);

				header("Location: registrohecho.html");
				exit();

			} else {
				echo "Error al crear registro: " . $conn->error;
			}

		}
	}		

	?>

	<!--php-->


	<div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
		<div class="col-sm-6">
			<h1>Crear cuenta</h1>
			<form action="cuentacrear.php" method="post" id="formulariocrearcuenta">

				<!--GRUPO NOMBRE-->
				<div class="formulary__group" id="grupo__nombre">
					<label for="nombre">Nombre:</label>
					<div class="form-group">
						<input type="text" class="form-control" id="nombre" name="nombre" placeholder="panchito"
							required>
					</div>
					<p class="formulario_input-error">El nombre debe tener de 3 a 16 dígitos y sólo puede contener
						letras</p>
				</div>


				<!--GRUPO CORREO-->
				<div class="formularygroup" id="grupo_correo">
					<label for="correo">Correo electrónico:</label>
					<div class="form-group">
						<input type="email" class="form-control" id="correo" name="correo"
							placeholder="correo@cuautla.tecnm.mx" required>
					</div>
					<p class="formulario_input-error">Sólo se aceptan correos del Tecnológico de Cuautla</p>
				</div>


				<!--GRUPO CONTRASEÑA-->
				<div class="formularygroup" id="grupo_contraseña">
					<label for="contraseña">Contraseña:</label>
					<div class="form-group">
						<input type="password" class="form-control" id="contraseña" name="contraseña"
							placeholder="contraseña" required>
					</div>
					<p class="formulario_input-error">La contraseña tiene que ser de 6 a 16 dígitos</p>
				</div>

				<!--GRUPO CONFIRMAR CONTRASEÑA-->
				<div class="formularygroup" id="grupo_confirmarcontraseña">
					<label for="confirmar-contraseña">Confirmar contraseña:</label>
					<div class="form-group">
						<input type="password" class="form-control" id="confirmar-contraseña"
							name="confirmar-contraseña" placeholder="contraseña" required>
					</div>
					<p class="formulario_input-error">Las contraseñas tienen que coincidir</p>
				</div>


				<div class="formularygroup formularygroup-btn-enviar">
					<button type="submit" class="btn btn-primary" name="btnRegister" style="margin-top: 12%">Registrarse</button>
					<p class="formulary_mensaje-exito">Registrado correctamente</p>
				</div>

			</form>

			<div class="formularygroup formularygroup-btn-enviar" style="padding-top: 5%;">
				<a href="index.html" type="button" class="btn btn-danger">Regresar</a>
			</div>

		</div>
	</div>
	<!--termina html-->




	<script src="scripts/codes.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>