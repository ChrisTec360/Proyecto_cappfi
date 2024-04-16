<?php
// Conecta a la base de datos
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
    $consulta = "SELECT * FROM usuarios WHERE correoUsuario='$correo' AND contrasenaUsuario='$contraseña'";
    $resultado = mysqli_query($conexion, $consulta);
    
    // Si la consulta devuelve un resultado, inicia la sesión y redirige al usuario
    if(mysqli_num_rows($resultado) == 1) {
        session_start();
        $usuario = mysqli_fetch_assoc($resultado);
        
        // Inserta el registro de inicio de sesión en la tabla ingresos
        $usuario_id = $usuario['idUsuario'];
        $hora = date('Y-m-d H:i:s');
        $insertar_ingreso = "INSERT INTO ingresos (FK_User, Hora) VALUES ('$usuario_id', '$hora')";
        mysqli_query($conexion, $insertar_ingreso);

        // Almacena los datos del usuario en variables de sesión
        $_SESSION['idUsuario'] = $usuario['idUsuario'];
        $_SESSION['correoUser'] = $correo;
        $_SESSION['nombreUsuario'] = $usuario['nombreUsuario']; // Aquí cambia a $usuario['nombreUsuario']
        $_SESSION['rolUsuario'] = $usuario['rolUsuario'];
        
        // Redirige al usuario según su rol
        if($usuario['rolUsuario'] == 'admin') {
            header("Location: menuproductos.php");
        } else {
            header("Location: peachepes/productosUsuarios.php");
        }
        exit();
    } else {
        // Si la consulta no devuelve un resultado, redirige a index.html con el parámetro "error=1"
        header("Location: index.html?error=1");
        exit();
    }
}

// Cierra la conexión a la base de datos
mysqli_close($conexion);
?>
