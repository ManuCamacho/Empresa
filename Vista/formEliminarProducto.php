<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Producto</title>
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
            <li><a href="formMostrarProductos.php">Mostrar Productos</a></li>
            <li><a href="formaddProducto.php">Añadir Producto</a></li>
            <li><a href="formActualizarProducto.php">Modificar Producto</a></li>
            <li><a href="formMostrarDescripcion.php">Filtrado por Descripcion</a></li>
            <li><a href="formMostrarProductosBajoStock.php">Filtrado por Stock</a></li>
            <li><a href="formInicioSesion.php" onclick="return confirmarCerrarSesion();">Cerrar Sesion</a></li>

        </ul>
    </nav>
    <h2>Eliminar Producto</h2>

    <?php
    include '../Controlador/controlaEliminarProducto.php';
    ?>

    <form id="eliminarForm" action="../Controlador/controlaEliminarProducto.php" method="post" onsubmit="return confirmarEliminar();">
        <label for="cod_producto">Seleccione el producto a eliminar:</label>
        <select name="cod_producto" required>
            <?php
            // Muestra la lista de productos
            foreach ($productos as $producto) {
                echo "<option value='{$producto->getCod_producto()}'>{$producto->getDescripcion()}</option>";
            }
            ?>
        </select><br><br>

        <input type="submit" value="Eliminar Producto">
        <?php
            // Verifica si hay un mensaje de éxito en la sesión
            if (isset($_SESSION['mensaje_exito'])) {
                echo '<div class="mensaje-exito">' . $_SESSION['mensaje_exito'] . '</div>';

                // Limpia la variable de sesión después de mostrar el mensaje
                unset($_SESSION['mensaje_exito']);
            }
        ?>
    </form>

    <script>
        function confirmarEliminar() {
            return confirm("¿Estás seguro de que quieres eliminar este producto?");
        }
    </script>

</body>
</html>
