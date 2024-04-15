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
  // Si la consulta devuelve un resultado, inicia la sesión y redirige al usuario a menuproductos.php

  if(mysqli_num_rows($resultado) == 1) {
    session_start();
    $usertype = $resultado->fetch_assoc();
    $username = $resultado->fetch_assoc();

    $_SESSION['idUsuario'] = $usertype['idUsuario'];
    $_SESSION['correoUser'] = $correo;
    $_SESSION['nombreUsuario'] = $username;

    $_SESSION['rolUsuario'] = $usertype['rolUsuario']; // Almacena el rol del usuario en una variable de sesión
    //verifica el rol
    if($usertype['rolUsuario'] == 'admin'){

      //$_SESSION['correito'] = $correo;
      header("Location: menuproductos.php");
    }else{
      //$_SESSION['correito'] = $correo;
      header("Location: peachepes/productosUsuarios.php");
    }

    exit();

  } else {
    // Si la consulta no devuelve un resultado, muestra un mensaje de error
    // Si la consulta no devuelve un resultado, redirige a index.html con el parámetro "error=1"
    //header("Location: index.html?error=1");
    //echo "El correo o la contraseña son incorrectos";

  header("Location: index.html?error=1");
  exit();

  }
}

// Cierra la conexión a la base de datos
mysqli_close($conexion);
?>