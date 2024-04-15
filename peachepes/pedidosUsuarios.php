<?php
    session_start();
    error_reporting(0);
    $idUsuario = $_SESSION['idUsuario'];
    require "connected.php";

    if ($idUsuario == null || $idUsuario == '') {
        echo 'No tienes autorización para entrar: logueate o crea una cuenta';
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PedidosDeUsuarios</title>

    <!-- Incluye los estilos de Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Incluye el script de Bootstrap -->
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css">

</head>

<body>



    <h1>TUS PEDIDOS</h1>
    <a href="productosUsuarios.php" type="button" class="btn btn-danger">Regresar</a>

    <?php
    session_start();
    error_reporting(0);
    $idUsuario = $_SESSION['idUsuario'];
    require "connected.php";

    if ($idUsuario == null || $idUsuario == '') {
        echo 'No tienes autorización para entrar';
        die();
    }

    // Obtener los datos de los pedidos y sus detalles
    $stmt = $mysqli->prepare("SELECT p.idPedido, p.fecha, p.total, p.FK_idUsuario, GROUP_CONCAT(CONCAT(d.FK_idProductos, ':', d.nombrePr, ':', d.cantidad, ':', d.precioProducto, ':', (d.cantidad * d.precioProducto))) AS productos
    FROM pedidos p
    INNER JOIN detallepedido d ON p.idPedido = d.FK_idPedido
    WHERE p.FK_idUsuario = ?
    GROUP BY p.idPedido DESC");
    $stmt->bind_param("i", $idUsuario);
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
                            <ul class="list-group list-group-flush">';
            }

            // Mostrar los detalles del producto dentro del pedido actual
            $productos = explode(',', $row['productos']);
            foreach ($productos as $producto) {
                $detalles = explode(':', $producto);
                echo '
                <div class="card-body">
                            <li class="list-group-item">Producto: ' . $detalles[1] . '</li>
                            <li class="list-group-item">Cantidad: ' . $detalles[2] . '</li>
                            <li class="list-group-item">Precio: ' . $detalles[3] . '</li>
                            <li class="list-group-item">Subtotal: ' . $detalles[4] . '</li>
                            </div>';
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