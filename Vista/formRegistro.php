<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav>
        <ul>
            <li><a href="formInicioSesion.php">Iniciar Sesion</a></li>
        </ul>
    </nav><br>
    <h1>Formulario de Registro</h1>

    <form action="../Controlador/controlaRegistro.php" method="post">
        <label for="cod_prov">Código de Proveedor:</label>
        <input type="text" id="cod_prov" name="cod_prov" required>

        <label for="pwd">Contraseña:</label>
        <input type="password" id="pwd" name="pwd" required>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" required>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" required>

        <input type="submit" value="Registrarse">
    </form>
</body>
</html>
