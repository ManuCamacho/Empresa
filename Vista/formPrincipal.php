<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
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
            
            <li><a href="formInicioSesion.php" onclick="return confirmarCerrarSesion();">Cerrar Sesion</a></li>

            
        </ul>
    </nav><br>
    <h1>Formulario Principal</h1>

    <form action="../Controlador/controlaPrincipal.php" method="post">
        <input type="submit" name="submit" value="Gestionar Productos">
        <input type="submit" name="submit" value="Gestionar Proveedores">

    </form>
</body>
</html>