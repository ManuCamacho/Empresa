<?php
include_once '../Modelo/ProductoDB.php';

try {
    // Inicia la sesión
    session_start();

    // Verifica si el usuario ha iniciado sesión y obtiene su cod_prov
    if (isset($_SESSION['cod_prov'])) {
        $cod_prov = $_SESSION['cod_prov'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtiene la descripción desde el formulario
            $descripcion = $_POST["descripcion"];

            // Obtiene la lista de productos filtrados por descripción
            $productos = ProductoDB::getByDescripcion($descripcion, $cod_prov);

            // Verifica si hay productos para mostrar
            if (!empty($productos)) {
                echo '<table border="1">';
                echo '<tr><th>Código</th><th>Descripción</th><th>Precio</th><th>Stock</th></tr>';

                foreach ($productos as $producto) {
                    echo "<tr>";
                    echo "<td>{$producto->getCod_producto()}</td>";
                    echo "<td>{$producto->getDescripcion()}</td>";
                    echo "<td>{$producto->getPrecio()}</td>";
                    echo "<td>{$producto->getStock()}</td>";
                    echo "</tr>";
                }

                echo '</table>';
            } else {
                echo '<p>No hay productos con la descripción proporcionada.</p>';
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
