<?php
include_once '../Modelo/ProductoDB.php';

try {
    // Inicia la sesión
    session_start();

    // Verifica si el usuario ha iniciado sesión y obtiene su cod_prov
    if (isset($_SESSION['cod_prov'])) {
        $cod_prov = $_SESSION['cod_prov'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtiene el límite de stock desde el formulario
            $stockLimite = $_POST["stockLimite"];

            // Obtiene la lista de productos con bajo stock del proveedor actual
            $productosBajoStock = ProductoDB::getBajoStockPorProveedor($stockLimite, $cod_prov);

            // Verifica si hay productos para mostrar
            if (!empty($productosBajoStock)) {
                echo '<table border="1">';
                echo '<tr><th>Código</th><th>Descripción</th><th>Precio</th><th>Stock</th></tr>';

                foreach ($productosBajoStock as $producto) {
                    echo "<tr>";
                    echo "<td>{$producto['cod_producto']}</td>";
                    echo "<td>{$producto['descripcion']}</td>";
                    echo "<td>{$producto['precio']}</td>";
                    echo "<td>{$producto['stock']}</td>";
                    echo "</tr>";
                }

                echo '</table>';
            } else {
                echo '<p>No hay productos con stock por debajo del límite proporcionado.</p>';
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
