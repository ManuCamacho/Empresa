<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Inicio de Sesion</title>
  <link rel="stylesheet" href="style.css">
 
</head>
<body>
<nav>
        <ul>
            <li><a href="formRegistro.php">Registrate</a></li>
        </ul>
    </nav><br>
    <h1>Formulario de Inicio de Sesión</h1>

  <form method="post" action="../Controlador/controlaInicio.php">
  <label for="usuario">Codigo de Proveedor:</label>
    <input type="text" name="cod_prov" required>

    <label for="password">Contraseña:</label>
    <input type="password" name="pwd" required>

    <input type="submit" value="Iniciar Sesion">
  </form>

</body>
</html>