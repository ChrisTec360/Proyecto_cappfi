<?php
// Verificar si se ha enviado el formulario
if (isset($_POST['btnPedir'])) {
    session_start();

    // Obtener los datos del formulario
    $totalPedido = $_POST['totalPedidoInput'];
    $idUsuario = $_SESSION['idUsuario']; // Suponiendo que tienes almacenado el ID del usuario en la sesión

    // Realizar la conexión a la base de datos
    require "connected.php";

    // Insertar el nuevo pedido en la tabla "pedidos"
    $stmt = $mysqli->prepare("INSERT INTO pedidos (fecha, total, FK_idUsuario) VALUES (NOW(), ?, ?)");
    $stmt->bind_param("di", $totalPedido, $idUsuario);
    $stmt->execute();

    // Verificar si la inserción fue exitosa
    if ($stmt->affected_rows > 0) {
        // El pedido se ha insertado correctamente
        // Obtener el ID del pedido recién insertado
        $idPedido = $stmt->insert_id;

        
        // Insertar los detalles del pedido en la tabla "detallePedido"
        foreach ($_SESSION['cart'] as $value) {
            // Obtener los valores necesarios para los campos del detallePedido
            $idProducto = $value['idProducto'];
            $nombreProducto = $value['nombreProducto']; // Nuevo campo añadido
            $cantidadProducto = $_POST['cantidadInput'][$idProducto];
            $precioProducto = $value['precioProducto'];
            $subtotal = $cantidadProducto * $precioProducto;

            // Insertar el detalle del pedido en la tabla "detallePedido"
            $stmtDetalle = $mysqli->prepare("INSERT INTO detallepedido (FK_idPedido, FK_idProductos, nombrePr, cantidad, precioProducto, subtotalProducto) VALUES (?, ?, ?, ?, ?, ?)");
            $stmtDetalle->bind_param("iisidd", $idPedido, $idProducto, $nombreProducto, $cantidadProducto, $precioProducto, $subtotal);
            $stmtDetalle->execute();
        }

        echo "¡Pedido realizado con éxito!";
        header("Location: pedidosUsuarios.php");
    } else {
        // Hubo un error al insertar el pedido
        echo "Error al realizar el pedido. Por favor, inténtalo nuevamente.";
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $mysqli->close();
}
?>
