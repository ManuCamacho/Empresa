<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Producto</title>
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
            <li><a href="formEliminarProducto.php">Eliminar Producto</a></li>
            <li><a href="formMostrarDescripcion.php">Filtrado por Descripcion</a></li>
            <li><a href="formMostrarProductosBajoStock.php">Filtrado por Stock</a></li>
            <li><a href="formInicioSesion.php" onclick="return confirmarCerrarSesion();">Cerrar Sesion</a></li>
        </ul>
    </nav>
<h2>Actualizar Producto</h2>

<?php
include '../Controlador/controlaActualizarProducto.php';
?>

<form action="../Controlador/controlaActualizarProducto.php" method="post" id="actualizarForm">
    <label for="cod_producto">Seleccione el producto a actualizar:</label>
    <select name="cod_producto" id="cod_producto" required>
        <?php
        // Muestra la lista de productos
        foreach ($productos as $producto) {
            echo "<option value='{$producto->getCod_producto()}'>{$producto->getDescripcion()}</option>";
        }
        ?>
    </select><br><br>

    <label for="descripcion">Nueva Descripción:</label>
    <input type="text" id="descripcion" name="descripcion" required><br>

    <label for="precio">Nuevo Precio:</label>
    <input type="number" id="precio" name="precio" required><br>

    <label for="stock">Nuevo Stock:</label>
    <input type="number" id="stock" name="stock" required><br>

    <input type="submit" value="Actualizar Producto">
    <?php
    // Verifica si hay un mensaje de éxito en la sesión
    if (isset($_SESSION['mensaje_exito'])) {
        echo '<div class="mensaje-exito">' . $_SESSION['mensaje_exito'] . '</div>';

        // Limpiar la variable de sesión después de mostrar el mensaje
        unset($_SESSION['mensaje_exito']);
    }
    ?>
</form>


</body>
</html>
