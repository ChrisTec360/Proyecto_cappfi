<?php
session_start();
error_reporting(0);
$varsession = $_SESSION['idUsuario'];

if ($varsession == null || $varsession == '') {
	echo 'No tienes autorización para entrar: cambio de contraseña';
	die();
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cambio de contraseña</title>
	<link rel="stylesheet" href="\proyecto_cappfi\css\bootstrap.min.css">
	<link rel="stylesheet" href="\proyecto_cappfi\css\styles.css">
	<link rel="stylesheet" href="Proyecto_cappfi\mycss\stylesmines.css">
	<link rel="stylesheet" href="\prouemystyles.css">

	<!-- SweetAlert2 CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>

<body class="p-3 mb-2 bg-warning text-dark">
	<div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
		<div class="col-sm-6">
			<h1 class="labelsColor">Cambio de contraseña</h1>
			<form action="" method="post" id="cambioContraseñaForm">

				<?php

				//verifica si se ha precionado "cambiar"
				if (isset($_POST['btnCambiarContra'])) {

					//var_dump($_POST);	
					require "connected.php";

					// Obtiene los valores del formulario
					$micontrasenaactual = $mysqli->real_escape_string($_POST['contrasenaActual']);
					$micontrasenanueva = $mysqli->real_escape_string($_POST['contraNueva']);
					$micontrasenanueva2 = $mysqli->real_escape_string($_POST['contraNuevaConfirmar']);

					//
					$llamaabdd = $mysqli->query("SELECT contrasenaUsuario FROM usuarios WHERE idUsuario = '" . $varsession . "'");
					$rowA = $llamaabdd->fetch_array();

					if ($rowA['contrasenaUsuario'] == $micontrasenaactual) {

						if ($micontrasenanueva == $micontrasenanueva2) {
							$updateContra = $mysqli->query("UPDATE usuarios SET contrasenaUsuario = '$micontrasenanueva' WHERE idUsuario = '" . $varsession . "'");

							if ($updateContra) {

								echo '
									<script>
									Swal.fire({
										icon: "success",
										title: "¡Contraseña cambiada correctamente!",
									})
									</script>
								';
								
							}

						} else {
							echo "Las contraseñas deben coincidir";
						}

					} else {
						echo "Tu contraseña actual es incorrecta";
					}

				}

				?>

				<div class="form-group">
					<label for="contraseña-actual" class="labelsColor">Contraseña actual:</label>
					<input type="password" class="form-control" name="contrasenaActual" id="contrasenaActual" required>
				</div>
				<div class="form-group">
					<label for="nueva-contraseña" class="labelsColor">Nueva contraseña:</label>
					<input type="password" class="form-control" name="contraNueva" id="contraNueva" required>
				</div>
				<div class="form-group">
					<label for="confirmar-nueva-contraseña" class="labelsColor">Confirmar nueva contraseña:</label>
					<input type="password" class="form-control" name="contraNuevaConfirmar" id="contraNuevaConfirmar"
						required>
				</div>
				<button type="submit" class="btn btn-primary" style="margin-top: 5%;" name="btnCambiarContra"
					id="btnCambiarContra">Cambiar</button>
				

				<button type="button" class="btn btn-danger" id="cancelarCambioContraseña" style="margin-top: 5%;"
					<?php						
						if ($_SESSION['rolUsuario'] == 'admin') {
							echo 'onclick="window.location.href = \'../menuproductos.php\';"';
						} else {
							echo 'onclick="window.location.href = \'productosUsuarios.php\';"';
						}
					?>
				>Regresar</button>
			</form>
		</div>
	</div>

	<script src="scripts/codes.js"></script>

</body>

</html>