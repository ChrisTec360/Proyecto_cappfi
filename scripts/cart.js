function agregaACarrito(idProducto) {
    // Crea un objeto FormData con el ID del producto como parametro
    var formData = new FormData();
    formData.append('idProducto', idProducto);

    // Realiza una solicitud AJAX para enviar los datos al archivo verCarrito.php
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../peachepes/verCarrito.php', true);
    xhr.onload = function() {
      if (xhr.status === 200) {
        // Actualiza el contenido del carrito con la respuesta recibida
        document.getElementById('carrito').innerHTML = xhr.responseText;
      } else {
        console.log('Error al agregar el producto al carrito');
      }
    };
    xhr.send(formData);
}