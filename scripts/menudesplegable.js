//menú desplegable con diferentes opciones

const productosBtn = document.getElementById("muestraproducto");
const pedidosBtn = document.getElementById("muestrapedidos");
const cambiarContraBtn = document.getElementById("muestracambiocontraseña");
const cerrarSesionBtn = document.getElementById("salirsesion");

function irAMenuProductos() {
  window.location.href = "menuproductos.php";
}

function irAPedidos() {
  window.location.href = "pedidos.html";
}

function irACambiarContra() {
  window.location.href = "cambiacontra.php";
}

function irAInicioSesion() {
  window.location.href = "peachepes/cierrasesion.php";
}


//productosBtn.addEventListener("click", irAMenuProductos);
pedidosBtn.addEventListener("click", irAPedidos);
//cambiarContraBtn.addEventListener("click", irACambiarContra);
cerrarSesionBtn.addEventListener("click", irAInicioSesion);