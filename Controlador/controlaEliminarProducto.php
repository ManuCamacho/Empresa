<?php
include_once '../Modelo/ProductoDB.php';
include_once '../Modelo/ProveedorDB.php';

try {
    // Inicia la sesión
    session_start();

    // Verifica si el usuario ha iniciado sesión y obtiene su cod_prov
    if (isset($_SESSION['cod_prov'])) {
        $cod_prov = $_SESSION['cod_prov'];

        // Obtiene la lista de productos del proveedor
        $productos = ProductoDB::getAll(new Proveedor($cod_prov, "", "", "", ""));

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $cod_producto = $_POST["cod_producto"];

            // Busca el producto en la lista
            $productoSeleccionado = null;
            foreach ($productos as $producto) {
                if ($producto->getCod_producto() == $cod_producto) {
                    $productoSeleccionado = $producto;
                    break;
                }
            }

            // Verifica si se encontró el producto
            if ($productoSeleccionado) {
                // Obtiene el proveedor del producto seleccionado
                $miProveedor = $productoSeleccionado->getMiProveedor();

                // Crea una instancia de la clase Producto
                $producto = new Producto($cod_producto, "", 0, 0, $miProveedor);

                // Llama al método delete de ProductoDB para eliminar el producto
                $result = ProductoDB::delete($cod_producto);

                if ($result) {
                    $_SESSION['mensaje_exito'] = "Producto eliminado correctamente";

                    // Redirige a la página que muestra el formulario 
                    header("Location: ../Vista/formEliminarProducto.php");
                    exit();
                } else {
                    die("No se ha podido eliminar el producto. Error en la base de datos.");
                }
            } else {
                die("Producto no encontrado.");
            }
        }
    } else {
        header("Location: ../Vista/formInicioSesion.php");
        exit();
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>