<?php
    class Proveedor{
        private string $cod_prov;
        private string $pwd;
        private string $nombre;
        private string $apellidos;
        private string $telefono;
        private array $misProductos;

        public function __construct(string $cod_prov, string $pwd, string $nombre, string $apellidos, string $telefono) {
                $this->cod_prov = $cod_prov;
                $this->pwd = $pwd;
                $this->nombre = $nombre;
                $this->apellidos = $apellidos;
                $this->telefono = $telefono;
                $this->misProductos = [];
            }

        public function getCod_prov()
        {
                return $this->cod_prov;
        }


        public function setCod_prov($cod_prov)
        {
                $this->cod_prov = $cod_prov;

                return $this;
        }


        public function getPwd()
        {
                return $this->pwd;
        }


        public function setPwd($pwd)
        {
                $this->pwd = $pwd;

                return $this;
        }

 
        public function getNombre()
        {
                return $this->nombre;
        }


        public function setNombre($nombre)
        {
                $this->nombre = $nombre;

                return $this;
        }


        public function getApellidos()
        {
                return $this->apellidos;
        }


        public function setApellidos($apellidos)
        {
                $this->apellidos = $apellidos;

                return $this;
        }

 
        public function getTelefono()
        {
                return $this->telefono;
        }


        public function setTelefono($telefono)
        {
                $this->telefono = $telefono;

                return $this;
        }


    }
?>