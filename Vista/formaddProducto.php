<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro de Producto</title>
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
            <li><a href="formActualizarProducto.php">Actualizar Producto</a></li>
            <li><a href="formEliminarProducto.php">Eliminar Producto</a></li>
            <li><a href="formMostrarDescripcion.php">Filtrado por Descripcion</a></li>
            <li><a href="formMostrarProductosBajoStock.php">Filtrado por Stock</a></li>
            <li><a href="formInicioSesion.php" onclick="return confirmarCerrarSesion();">Cerrar Sesion</a></li>

            
        </ul>
    </nav>

<h2>Registro de Producto</h2>

<form action="../Controlador/controlaAddProducto.php" method="post">
    <label for="cod_producto">Código del Producto:</label>
    <input type="text" id="cod_producto" name="cod_producto" required><br>

    <label for="descripcion">Descripción:</label>
    <input type="text" id="descripcion" name="descripcion" required><br>

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" required><br>

    <label for="stock">Stock:</label>
    <input type="number" id="stock" name="stock" required><br>

    <input type="hidden" name="cod_prov" value="<?php echo isset($cod_prov) ? $cod_prov : ''; ?>">

    <input type="submit" value="Registrar Producto">
    <?php
            // Verifica si hay un mensaje de éxito en la sesión
            if (isset($_SESSION['mensaje_exito'])) {
                echo '<div class="mensaje-exito">' . $_SESSION['mensaje_exito'] . '</div>';

                // Limpia la variable de sesión después de mostrar el mensaje
                unset($_SESSION['mensaje_exito']);
            }
        ?>
</form>

</body>
</html>
