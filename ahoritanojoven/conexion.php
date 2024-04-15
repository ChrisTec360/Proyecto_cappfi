<?php
  $servername = "localhost:3306";
  $username = "root";
  $password = "contraseñasegura";
  $dbname = "proyectocappfy";

  // Crea la conexión
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Verifica si hay errores de conexión
  if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
  }

  // Obtener los valores del formulario
  $nombre = $_POST["nombre"];
  $correo = $_POST["correo"];
  $contraseña = $_POST["contraseña"];

  // Ejecutar sentencia SQL INSERT
  $sql = "INSERT INTO usuarios (nombreUsuario, correoUsuario, contrasenaUsuario) VALUES ('$nombre', '$correo', '$contraseña')";
  if ($conn->query($sql) === TRUE) {
    echo "Cuenta creada exitosamente";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  // Cerrar la conexión
  $conn->close();
?>