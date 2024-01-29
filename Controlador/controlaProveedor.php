<?php
include_once '../Modelo/ProveedorDB.php';

// Verificar si el proveedor ha iniciado sesión
session_start();
if (!isset($_SESSION['cod_prov'])) {
    // Redirige a la página de inicio de sesión si no hay sesión activa
    header("Location: ../Vista/index.php");
    exit();
}

// Obtiene el proveedor por su código de la sesión
$cod_prov = $_SESSION['cod_prov'];
$proveedor = ProveedorDB::getProveedor($cod_prov);

if (!$proveedor) {
    echo "Proveedor no encontrado.";
    exit();
}

// Verificar si se ha enviado la solicitud POST para actualizar los datos del proveedor
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    // Obtiene los datos actualizados del formulario
    $newPwd = $_POST["pwd"];
    $newNombre = $_POST["nombre"];
    $newApellidos = $_POST["apellidos"];
    $newTelefono = $_POST["telefono"];

    // Verifica si la contraseña ha cambiado
    if ($newPwd !== $proveedor->getPwd()) {
        // Actualiza la contraseña solo si ha cambiado
        $proveedor->setPwd(password_hash($newPwd, PASSWORD_BCRYPT));
    }

    // Actualiza el resto de la información del proveedor
    $proveedor->setNombre($newNombre);
    $proveedor->setApellidos($newApellidos);
    $proveedor->setTelefono($newTelefono);

    // Guarda los cambios en la base de datos
    ProveedorDB::update($proveedor);

    // Establece una variable de sesión con el mensaje de éxito
    $_SESSION['mensaje_exito'] = "Proveedor modificado correctamente";

    // Redirige a la página que muestra el formulario
    header("Location: ../Vista/formGestionProveedores.php");
    exit();
}
?>
