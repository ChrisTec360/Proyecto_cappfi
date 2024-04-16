<?php
// Conexión a la base de datos
// Datos de conexión a la base de datos
$servername = '127.0.0.1:3308';
$username = 'nuevo_usuario';
$password = 'contraseña_segura';
$dbname = 'proyectocappfy';

$conexion = mysqli_connect($servername, $username, $password, $dbname);

// Verifica si se ha presionado el botón "Ingresar"
if(isset($_POST['btnIngreso'])) {
    // Obtiene los valores del formulario
    $correo = $_POST['correoIngreso'];
    $contraseña = $_POST['contraseñaIngreso'];

    // Consulta la base de datos para verificar si el correo y contraseña son correctos
    $consulta = "SELECT * FROM usuarios WHERE correoUsuario='$correo'";
    $resultado = mysqli_query($conexion, $consulta);



    // Verifica si se encontró algún usuario con el correo proporcionado
    if(mysqli_num_rows($resultado) == 1) {
        $usuario = mysqli_fetch_assoc($resultado);

        // Verifica si el usuario está bloqueado y si han pasado dos minutos desde el bloqueo
        if($usuario['bloqueado'] == 1 && strtotime($usuario['tiempo_bloqueo']) < time()) {
          // Elimina el bloqueo del usuario
          $desbloquear_usuario = "UPDATE usuarios SET bloqueado = 0, tiempo_bloqueo = NULL WHERE idUsuario = " . $usuario['idUsuario'];
          mysqli_query($conexion, $desbloquear_usuario);
        }

        // Verifica si el usuario está bloqueado
        if($usuario['bloqueado'] == 1 && strtotime($usuario['tiempo_bloqueo']) > time()) {
          // El usuario está bloqueado, redirige con un mensaje de error
          header("Location: index.html?bloqueo=1");
          exit();
        }

        // Verifica si la contraseña es correcta
        if($contraseña === $usuario['contrasenaUsuario']) {
          // La contraseña es correcta, reinicia el contador de intentos fallidos
          $reset_intentos = "UPDATE usuarios SET intentos = 0 WHERE idUsuario = " . $usuario['idUsuario'];
          mysqli_query($conexion, $reset_intentos);

            // Obtener el ID del usuario
            $usuario_id = $usuario['idUsuario'];

            // La contraseña es correcta, inicia sesión y redirige al usuario
            session_start();
            $_SESSION['idUsuario'] = $usuario['idUsuario'];
            $_SESSION['correoUser'] = $correo;
            $_SESSION['nombreUsuario'] = $usuario['nombreUsuario'];
            $_SESSION['rolUsuario'] = $usuario['rolUsuario'];

            // Usuario válido, realiza la inserción en la tabla de ingresos
            $hora_ingreso = date('Y-m-d H:i:s');
            $insertar_ingreso = "INSERT INTO ingresos (FK_User, Hora) VALUES ('$usuario_id', '$hora_ingreso')";
            mysqli_query($conexion, $insertar_ingreso);

            if($usuario['rolUsuario'] == 'admin') {
                header("Location: menuproductos.php");
            } else {
                header("Location: peachepes/productosUsuarios.php");
            }
            exit();
        } else {
            // La contraseña es incorrecta, incrementa el contador de intentos fallidos
            $intentos_fallidos = $usuario['intentos'] + 1;
            $update_intentos = "UPDATE usuarios SET intentos = $intentos_fallidos WHERE idUsuario = " . $usuario['idUsuario'];
            mysqli_query($conexion, $update_intentos);

            // Si el usuario alcanza el límite de intentos fallidos, bloquea al usuario
            if($intentos_fallidos >= 3) {
              $tiempo_bloqueo = date('Y-m-d H:i:s', strtotime('+2 minutes'));
              $bloquear_usuario = "UPDATE usuarios SET bloqueado = 1, tiempo_bloqueo = '$tiempo_bloqueo' WHERE idUsuario = " . $usuario['idUsuario'];
              mysqli_query($conexion, $bloquear_usuario);

              // Redirige con un mensaje de error
              header("Location: index.html?bloqueo=1");
              exit();
            } else {
              // La contraseña es incorrecta, redirige con un mensaje de error
              header("Location: index.html?incorrect=1");
              exit();
            }
        }
    } else {
        // No se encontró ningún usuario con el correo proporcionado, redirige con un mensaje de error
        header("Location: index.html?notfound=1");
        exit();
    }
}

// Cierra la conexión a la base de datos
mysqli_close($conexion);
?>
