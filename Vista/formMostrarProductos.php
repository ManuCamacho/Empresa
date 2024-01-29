<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Productos</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function confirmarCerrarSesion() {
            return confirm("¿Estás seguro de que deseas cerrar sesión?");
        }
    </script>
</head>
<body>
<nav>
        <ul>
            <li><a href="formPrincipal.php">Inicio</a></li>
            <li><a href="formaddProducto.php">Añadir Productos</a></li>
            <li><a href="formActualizarProducto.php">Actualizar Producto</a></li>
            <li><a href="formEliminarProducto.php">Eliminar Producto</a></li>
            <li><a href="formMostrarDescripcion.php">Filtrado por Descripcion</a></li>
            <li><a href="formMostrarProductosBajoStock.php">Filtrado por Stock</a></li>
            <li><a href="formInicioSesion.php" onclick="return confirmarCerrarSesion();">Cerrar Sesion</a></li>

            
        </ul>
    </nav>

<h2>Listado de Productos</h2>

<?php
include '../Controlador/controlaMostrarProducto.php';

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
    echo '<p>No hay productos registrados.</p>';
}
?>

</body>
</html>
