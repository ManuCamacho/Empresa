<?php
    class Producto{
        private string $cod_producto;
        private string $descripcion;
        private float $precio;
        private int $stock;
        private Proveedor $miProveedor;

        public function __construct(string $cod_producto, string $descripcion, float $precio, int $stock, Proveedor $miProveedor) {
            $this->cod_producto = $cod_producto;
            $this->descripcion = $descripcion;
            $this->precio = $precio;
            $this->stock = $stock;
            $this->miProveedor = $miProveedor;
        }

        public function getCod_producto()
        {
                return $this->cod_producto;
        }

        public function setCod_producto($cod_producto)
        {
                $this->cod_producto = $cod_producto;

                return $this;
        }


        public function getDescripcion()
        {
                return $this->descripcion;
        }


        public function setDescripcion($descripcion)
        {
                $this->descripcion = $descripcion;

                return $this;
        }


        public function getPrecio()
        {
                return $this->precio;
        }


        public function setPrecio($precio)
        {
                $this->precio = $precio;

                return $this;
        }

 
        public function getStock()
        {
                return $this->stock;
        }

 
        public function setStock($stock)
        {
                $this->stock = $stock;

                return $this;
        }
 

    }

?>