<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Productos por Stock</title>
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
            <li><a href="formaddProducto.php">Añadir Productos</a></li>
            <li><a href="formActualizarProducto.php">Actualizar Producto</a></li>
            <li><a href="formEliminarProducto.php">Eliminar Producto</a></li>
            <li><a href="formMostrarDescripcion.php">Filtrado por Descripcion</a></li>
            <li><a href="formInicioSesion.php" onclick="return confirmarCerrarSesion();">Cerrar Sesion</a></li>
            
        </ul>
    </nav>
<h2>Mostrar Productos por Stock</h2>

<?php
include '../Controlador/controlaMostrarProductosBajoStock.php';
?>

<form action="../Controlador/controlaMostrarProductosBajoStock.php" method="post">
    <label for="stockLimite">Stock por debajo de:</label>
    <input type="number" id="stockLimite" name="stockLimite" required><br>

    <input type="submit" value="Mostrar Productos">
</form>

</body>
</html>
