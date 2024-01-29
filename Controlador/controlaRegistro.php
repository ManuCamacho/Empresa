<?php

include_once '../Modelo/ProveedorDB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cod_prov = $_POST["cod_prov"];
    $pwd = $_POST["pwd"];
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $telefono = $_POST["telefono"];

    try {
        $proveedorDB = ProveedorDB::Registro($cod_prov, $pwd, $nombre, $apellidos, $telefono);

        if ($proveedorDB) {
            echo "El usuario $nombre ha sido introducido en el sistema con la contraseña $pwd. Ahora puedes iniciar sesión.";
            echo '<form action="../Vista/formInicioSesion.php" method="get">';
            echo '<input type="submit" value="Pulse aquí para ir a la pantalla de inicio de sesión">';
            echo '</form>';
            exit();
        } else {
            echo "No se ha podido realizar el registro.";
        }
    } catch (PDOException $e) {
        // Verifica si la excepción es por una clave primaria duplicada
        if ($e->getCode() == '23000' && $e->errorInfo[1] == 1062) {
            echo "Error: El usuario con el código $cod_prov ya existe. Por favor, elige otro código.";
        } else {
            // En caso de otro tipo de excepción, imprime el mensaje de error
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
