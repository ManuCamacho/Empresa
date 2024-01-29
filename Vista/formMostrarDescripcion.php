<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Productos por Descripción</title>
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
            <li><a href="formActualizarProducto.php">Actualizar Producto</a></li>
            <li><a href="formEliminarProducto.php">Eliminar Producto</a></li>
            <li><a href="formMostrarProductosBajoStock.php">Filtrado por Stock</a></li>
            <li><a href="formInicioSesion.php" onclick="return confirmarCerrarSesion();">Cerrar Sesion</a></li>

            
        </ul>
    </nav>
<h2>Mostrar Productos por Descripción</h2>

<?php
include '../Controlador/controlaMostrarProductosFiltrados.php';

// Obtiene todas las descripciones de productos
$descripciones = ProductoDB::getAllDescriptions($cod_prov);


?>

<form action="../Controlador/controlaMostrarProductosFiltrados.php" method="post">
    <label for="descripcion">Seleccione la descripción:</label>
    <select name="descripcion" required>
        <?php
        // Muestra las opciones de descripciones
        foreach ($descripciones as $descripcion) {
            echo "<option value='$descripcion'>$descripcion</option>";
        }
        ?>
    </select><br><br>

    <input type="submit" value="Mostrar Productos">
</form>


</body>
</html>
