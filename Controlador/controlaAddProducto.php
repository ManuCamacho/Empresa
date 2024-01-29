<?php

include_once '../Modelo/ProductoDB.php';

try {
    // Inicia la sesión
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cod_producto = $_POST["cod_producto"];
        $descripcion = $_POST["descripcion"];
        $precio = $_POST["precio"];
        $stock = $_POST["stock"];

        // Verifica si el usuario ha iniciado sesión y obtiene su cod_prov desde la sesión
        if (isset($_SESSION['cod_prov'])) {
            $cod_prov = $_SESSION['cod_prov'];

            // Crear una instancia de la clase Proveedor
            $proveedor = new Proveedor($cod_prov, "", "", "", "");

            // Crear una instancia de la clase Producto
            $producto = new Producto($cod_producto, $descripcion, $precio, $stock, $proveedor);

            // Llamar al método add de ProductoDB para insertar el producto
            $result = ProductoDB::add($producto, $proveedor);

            if ($result) {
                $_SESSION['mensaje_exito'] = "Producto añadido correctamente";

                // Redirige a la página que muestra el formulario
                header("Location: ../Vista/formActualizarProducto.php");
                exit();

            } else {
                die("No se ha podido añadir el producto. Error en la base de datos.");
            }
        } else {
            die("Producto no añadido.");
        }
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}

?>
