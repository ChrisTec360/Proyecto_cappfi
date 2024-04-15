<?php
session_start();
//error_reporting(0);
$varsession = $_SESSION['idUsuario'];

if ($varsession == null || $varsession == '') {
    echo 'No tienes autorización para entrar: necesitas permisos de administrador';
    die();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Pedidos</title>
    <!-- Agrega aquí los enlaces a los archivos de estilo y scripts que necesites -->

    <!-- Incluye los estilos de Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Incluye el script de Bootstrap -->
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <!-- Enlace al archivo JavaScript de Bootstrap -->

</head>

<body style="background: #E95100">
    <h1>Pedidos</h1>
    <div>
        <a href="../menuProductos.php" type="button" class="btn btn-danger">REGRESAR</a>
    </div>
        
    <?php
        // Realizar la conexión a la base de datos
        require "connected.php";

        // Obtener los datos de los pedidos y sus detalles
        $stmt = $mysqli->prepare("SELECT p.idPedido, p.fecha, p.total, p.FK_idUsuario, GROUP_CONCAT(CONCAT(d.FK_idProductos, ':', d.nombrePr, ':', d.cantidad, ':', d.precioProducto, ':', (d.cantidad * d.precioProducto))) AS productos
        FROM pedidos p
        INNER JOIN detallepedido d ON p.idPedido = d.FK_idPedido
        GROUP BY p.idPedido DESC");
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si se encontraron registros
        if ($result->num_rows > 0) {
     // Inicializar una variable para contar los pedidos mostrados
     $pedidoCount = 0;

     // Iniciar la primera fila
     echo '<div class="row">';
 
     while ($row = $result->fetch_assoc()) {
 
         // Verificar si es el inicio de un nuevo pedido
         if ($pedidoCount != $row['idPedido']) {
             // Cerrar la card anterior si existe
             if ($pedidoCount !== 0) {
                 echo '</ul></div></div></div>';
             }
 
             // Abrir una nueva card para el pedido actual
             echo '<div class="col-md-4">
                 <div class="card mb-4">
                     <div class="card-body">
                         <h5 class="card-title">ID PEDIDO: ' . $row['idPedido'] . '</h5>
                         <p class="card-text">Fecha: ' . $row['fecha'] . '</p>
                         <p class="card-text">Total: ' . $row['total'] . '</p>
                         <p class="card-text">ID Usuario: ' . $row['FK_idUsuario'] . '</p>
                         <ul class="list-group list-group-flush">';
         }
 
         // Mostrar los detalles del producto dentro del pedido actual
         $productos = explode(',', $row['productos']);
         foreach ($productos as $producto) {
            $detalles = explode(':', $producto, 5);
            $numDetalles = count($detalles);
        
            // Verificar si hay suficientes elementos en $detalles y FK_idProductos no es NULL
            if ($numDetalles >= 5 && $detalles[0] !== 'NULL' && $detalles[4] !== '') {
                echo '
                <div class="card-body">
                    <li class="list-group-item">Producto: ' . $detalles[1] . '</li>
                    <li class="list-group-item">Cantidad: ' . $detalles[2] . '</li>
                    <li class="list-group-item">Precio: ' . $detalles[3] . '</li>
                    <li class="list-group-item">Subtotal: ' . $detalles[4] . '</li>
                </div>';
            }
        }
        
        
 
         // Actualizar el contador de pedidos mostrados
         $pedidoCount = $row['idPedido'];
 
         // Cerrar la card si es el último registro
         if ($pedidoCount === $result->num_rows) {
             echo '</ul></div></div></div>';
         }
     }
 
     // Cerrar la última fila de cards
     echo '</div>';

        } else {
            // No se encontraron registros
            echo "No se encontraron pedidos.";
        }

        // Cerrar la conexión y liberar recursos
        $stmt->close();
        $mysqli->close();
    ?>




</body>

</html>