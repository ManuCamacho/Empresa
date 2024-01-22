<?php
include_once 'Proveedor.php';
include_once 'Producto.php';
include_once 'ProductoDB.php';

class ProveedorDB {

    // Método para agregar un proveedor a la base de datos
    public static function add(Proveedor $proveedor): bool {
        $result = false;

        include_once '../Conexion/conexion.php';
        $conexion = Conexion::obtenerConexion();

        // Prepara la consulta SQL
        $sql = "INSERT INTO proveedor (cod_prov, pwd, nombre, apellidos, telefono) VALUES (:cod_prov, :pwd, :nombre, :apellidos, :telefono)";
        $sentencia = $conexion->prepare($sql);

        // Asigna los valores de los parámetros
        $sentencia->bindValue(":cod_prov", $proveedor->getCod_prov());
        $sentencia->bindValue(":pwd", $proveedor->getPwd());
        $sentencia->bindValue(":nombre", $proveedor->getNombre());
        $sentencia->bindValue(":apellidos", $proveedor->getApellidos());
        $sentencia->bindValue(":telefono", $proveedor->getTelefono());

        // Ejecuta la consulta y actualiza el resultado
        $result = $sentencia->execute();

        return $result;
    }

    // Método para actualizar la información de un proveedor en la base de datos
    public static function update(Proveedor $proveedor): bool {
        $result = false;

        include_once '../Conexion/conexion.php';
        $conexion = Conexion::obtenerConexion();

        // Prepara la consulta SQL
        $sql = "UPDATE proveedor SET pwd = :pwd, nombre = :nombre, apellidos = :apellidos, telefono = :telefono WHERE cod_prov = :cod_prov";
        $sentencia = $conexion->prepare($sql);

        // Asigna los valores de los parámetros
        $sentencia->bindValue(":pwd", $proveedor->getPwd());
        $sentencia->bindValue(":nombre", $proveedor->getNombre());
        $sentencia->bindValue(":apellidos", $proveedor->getApellidos());
        $sentencia->bindValue(":telefono", $proveedor->getTelefono());
        $sentencia->bindValue(":cod_prov", $proveedor->getCod_prov());

        // Ejecuta la consulta y actualiza el resultado
        $result = $sentencia->execute();

        return $result;
    }

    // Método para eliminar un proveedor de la base de datos
    public static function delete($cod_prov): bool {
        $result = false;

        // Incluye el archivo de conexión
        include_once '../Conexion/conexion.php';
        $conexion = Conexion::obtenerConexion();

        // Prepara la consulta SQL
        $sql = "DELETE FROM proveedor WHERE cod_prov = :cod_prov";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":cod_prov", $cod_prov);

        // Ejecuta la consulta y actualiza el resultado
        $result = $sentencia->execute();

        return $result;
    }

    // Método para obtener un proveedor por su código
    public static function select($cod_prov): Proveedor {
        // Incluye el archivo de conexión
        include_once '../Conexion/conexion.php';
        $conexion = Conexion::obtenerConexion();

        // Prepara la consulta SQL
        $sql = "SELECT * FROM proveedor WHERE cod_prov = :cod_prov";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":cod_prov", $cod_prov);
        $sentencia->execute();

        // Obtiene el resultado de la consulta
        $result = $sentencia->fetch(PDO::FETCH_ASSOC);

        // Crea un objeto Proveedor con la información obtenida
        $proveedor = new Proveedor();
        $proveedor->setCod_prov($result['cod_prov']);
        $proveedor->setPwd($result['pwd']);
        $proveedor->setNombre($result['nombre']);
        $proveedor->setApellidos($result['apellidos']);
        $proveedor->setTelefono($result['telefono']);

        return $proveedor;
    }

    // Método para obtener un proveedor por su código usando un método estático alternativo
    public static function getProveedor(string $cod_prov): Proveedor {
        // Incluye el archivo de conexión
        include_once '../Conexion/obtenerConexion.php';
        $conexion = ObtenerConexion::obtenerConexion();

        // Prepara la consulta SQL
        $sql = "SELECT * FROM proveedor WHERE cod_prov = :cod_prov";
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute(['cod_prov' => $cod_prov]);

        // Obtiene el resultado de la consulta
        $proveedor = $sentencia->fetch(PDO::FETCH_ASSOC);

        // Crea un objeto Proveedor con la información obtenida
        $prov = new Proveedor($proveedor['cod_prov'], $proveedor['pwd'], $proveedor['nombre'], $proveedor['apellidos'], $proveedor['telefono']);

        return $prov;
    }

    // Método para obtener un proveedor con sus productos
    public static function getCompleto(string $cod_prov): Proveedor {
        // Inicializa un array para almacenar los productos
        $productos = [];

        // Obtiene el proveedor por su código
        $proveedor = self::getProveedor($cod_prov);

        // Obtiene los productos del proveedor usando el método de ProductoDB
        $productos = ProductoDB::getProducto($proveedor);

        // Asigna los productos al proveedor
        $proveedor->setProductos($productos);

        return $proveedor;
    }
}
?>
