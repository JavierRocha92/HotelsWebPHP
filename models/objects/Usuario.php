<?php
class Usuario{
    private $id;
    private $nombre;
    private $contraseña;
    private $fecha_regsitro;
    private $rol;
    
    function __construct(){
        
    }
    
    public function __toString() {
        return "Usuario ID: {$this->id}\nNombre: {$this->nombre}\nFecha de registro: {$this->fecha_registro}\nRol: {$this->rol}";
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getContraseña() {
        return $this->contraseña;
    }

    public function getFecha_regsitro() {
        return $this->fecha_regsitro;
    }

    public function getRol() {
        return $this->rol;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function setContraseña($contraseña): void {
        $this->contraseña = $contraseña;
    }

    public function setFecha_regsitro($fecha_regsitro): void {
        $this->fecha_regsitro = $fecha_regsitro;
    }

    public function setRol($rol): void {
        $this->rol = $rol;
    }


}
