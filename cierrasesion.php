<?php 
    session_start();
    session_destroy();
    echo "cerrando sesión";
    header("Location: index.html");
?>