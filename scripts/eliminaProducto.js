//borrar un producto de la base de datos

function confirmarEliminarProducto(codigo) {
  Swal.fire({
    title: "¿Seguro que quieres eliminar este producto?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Eliminar",
    confirmButtonColor: "#3085d6",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: 'POST',
        url: 'peachepes/eliminarProducto.php',
        data: { idd: codigo },
        success: function (data) {
          Swal.fire({
            title: "¡ELIMINACIÓN!",
            text: "Producto eliminado",
            icon: "success",
          }).then((result) => {
            window.location.href = "menuproductos.php";
          });
        },
        error: function (xhr, status, error) {
          Swal.fire({
            title: "Error",
            text: "No se pudo eliminar el producto",
            icon: "error",
          });
        }
      });
    }
  });
}
