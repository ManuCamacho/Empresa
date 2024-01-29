<?php
include_once '../Modelo/ProductoDB.php';
include_once '../Modelo/ProveedorDB.php';

try {
    // Inicia la sesión
    session_start();

    // Verifica si el usuario ha iniciado sesión y obtén su cod_prov desde la sesión
    if (isset($_SESSION['cod_prov'])) {
        $cod_prov = $_SESSION['cod_prov'];

        // Obtén la lista de productos del proveedor
        $productos = ProductoDB::getAll(new Proveedor($cod_prov, "", "", "", ""));

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $cod_producto = $_POST["cod_producto"];
            $descripcion = $_POST["descripcion"];
            $precio = $_POST["precio"];
            $stock = $_POST["stock"];

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
                $producto = new Producto($cod_producto, $descripcion, $precio, $stock, $miProveedor);

                // Llama al método update de ProductoDB para actualizar el producto
                $result = ProductoDB::update($producto);

                if ($result) {
                    $_SESSION['mensaje_exito'] = "Producto modificado correctamente";

                    // Redirigir a la página que muestra el formulario
                    header("Location: ../Vista/formActualizarProducto.php");
                    exit();

                } else {
                    die("No se ha podido actualizar el producto. Error en la base de datos.");
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
