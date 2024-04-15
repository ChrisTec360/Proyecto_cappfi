function incrementarCantidad(idProducto) {
    var cantidadLabel = document.getElementById("cantidadProduct" + idProducto);
    var cantidadInput = document.getElementById("cantidadInput" + idProducto);
    var cantidad = parseInt(cantidadLabel.textContent);
    cantidad = cantidad + 1;
    
    // Actualiza la cantidad
    cantidadLabel.textContent = cantidad;
    cantidadInput.value = cantidad;
  
    // Recalcula el subtotal y actualiza el total
    var precioLabel = document.getElementById("subtotalProduct" + idProducto);
    var precio = parseFloat(precioLabel.dataset.precio);
    var subtotal = precio * cantidad;
    precioLabel.textContent = subtotal.toFixed(2);
  
    actualizarTotal();
}
  
function decrementarCantidad(idProducto) {
    var cantidadLabel = document.getElementById("cantidadProduct" + idProducto);
    var cantidadInput = document.getElementById("cantidadInput" + idProducto);
    var cantidad = parseInt(cantidadLabel.textContent);
    cantidad = cantidad - 1;
  
    // Verifica que la cantidad no sea menor que 1
    if (cantidad < 1) {
      cantidad = 1;
    }
  
    // Actualiza la cantidad
    cantidadLabel.textContent = cantidad;
    cantidadInput.value = cantidad;

    // Recalcula el subtotal y actualiza el total
    var precioLabel = document.getElementById("subtotalProduct" + idProducto);
    var precio = parseFloat(precioLabel.dataset.precio);
    var subtotal = precio * cantidad;
    precioLabel.textContent = subtotal.toFixed(2);

   
    actualizarTotal();
}
  
function actualizarTotal() {
  //var total = 0;  // Inicializa total como un número
  var total = 0;
  // Recorre las filas de la tabla y suma los subtotales
  var filas = document.querySelectorAll("table tr");
  for (var i = 1; i < filas.length - 1; i++) {
    var fila = filas[i];
    var cantidadLabel = fila.querySelector("label[id^='cantidadProduct']");
    var precioLabel = fila.querySelector("label[id^='subtotalProduct']");
    var cantidad = parseInt(cantidadLabel.textContent);
    var precio = parseFloat(precioLabel.dataset.precio);
    var subtotal = cantidad * precio;
    precioLabel.textContent = subtotal.toFixed(2);
    total += subtotal;
  }

  // Muestra el total en el elemento con el ID "totalPedidoLabel"
  document.getElementById("totalPedidoLabel").textContent = total.toFixed(2);
  // Asigna el valor al campo oculto
  document.getElementById("totalPedidoInput").value = total.toFixed(2);
}

