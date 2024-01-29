
<?php
include_once '../Controlador/controlaProveedor.php';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Proveedores - Perfil del Proveedor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav>
        <ul>
            <li><a href="formPrincipal.php">Inicio</a></li>
            <li><a href="formInicioSesion.php" onclick="return confirmarCerrarSesion();">Cerrar Sesion</a></li>
        </ul>
    </nav>
    <h1>Gestión de Proveedores</h1>

    <form action="../Controlador/controlaProveedor.php" method="post">
        <label for="cod_prov">Código de Proveedor:</label>
        <input type="text" id="cod_prov" name="cod_prov" value="<?php echo $proveedor->getCod_prov(); ?>" readonly>

        <label for="pwd">Contraseña:</label>
        <input type="text" id="pwd" name="pwd" value="<?php echo $proveedor->getPwd(); ?>" required>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $proveedor->getNombre(); ?>" required>

        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" value="<?php echo $proveedor->getApellidos(); ?>" required>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" value="<?php echo $proveedor->getTelefono(); ?>" required>

        <input type="submit" name="update" value="Actualizar">
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
