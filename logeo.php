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

        // Verifica si la contraseña es correcta
        if(password_verify($contraseña, $usuario['contrasenaUsuario'])) {
            // La contraseña es correcta, inicia sesión y redirige al usuario
            session_start();
            $_SESSION['idUsuario'] = $usuario['idUsuario'];
            $_SESSION['correoUser'] = $correo;
            $_SESSION['nombreUsuario'] = $usuario['nombreUsuario'];
            $_SESSION['rolUsuario'] = $usuario['rolUsuario'];

            if($usuario['rolUsuario'] == 'admin') {
                header("Location: menuproductos.php");
            } else {
                header("Location: peachepes/productosUsuarios.php");
            }
            exit();
        } else {
            // La contraseña es incorrecta, redirige con un mensaje de error
            header("Location: index.html?incorrect=1");
            exit();
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
