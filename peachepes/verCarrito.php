<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>hola carrito</h1>


    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtener el ID del producto enviado por AJAX
  $idProducto = $_POST['idProducto'];

  // Aquí puedes realizar las operaciones necesarias con el ID del producto, como agregarlo al carrito en la base de datos

  // Devuelve la respuesta con el contenido actualizado del carrito (puedes ajustar esto según tus necesidades)
  echo 'Producto agregado al carrito';
}
?>

<script src="../scripts/cart.js"></script>
    
</body>
</html>