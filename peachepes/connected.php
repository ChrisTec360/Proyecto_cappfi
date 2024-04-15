<?php

    $mysqli = new mysqli("127.0.0.1:3308", "nuevo_usuario", "contraseña_segura", "proyectocappfy");
    if($mysqli->connect_errno){
        echo "Falló la conexión a la base de datos";
    }

    return $mysqli;

?>