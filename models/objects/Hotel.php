<?php
class Hotel{
    private $id;
    private $nombre;
    private $direccion;
    private $ciudad;
    private $pais;
    private $num_habitacioes;
    private $descripcion;
    private $foto;
    
    function __construct(){
        
    }
    
    public function __toString() {
        return "Hotel: {$this->nombre}\nID: {$this->id}\nDirección: {$this->direccion}\nCiudad: {$this->ciudad}\nPaís: {$this->pais}\nNúmero de habitaciones: {$this->num_habitaciones}\nDescripción: {$this->descripcion}\nFoto: {$this->foto}";
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getCiudad() {
        return $this->ciudad;
    }

    public function getPais() {
        return $this->pais;
    }

    public function getNum_habitacioes() {
        return $this->num_habitacioes;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function setDireccion($direccion): void {
        $this->direccion = $direccion;
    }

    public function setCiudad($ciudad): void {
        $this->ciudad = $ciudad;
    }

    public function setPais($pais): void {
        $this->pais = $pais;
    }

    public function setNum_habitacioes($num_habitacioes): void {
        $this->num_habitacioes = $num_habitacioes;
    }

    public function setDescripcion($descripcion): void {
        $this->descripcion = $descripcion;
    }

    public function setFoto($foto): void {
        $this->foto = $foto;
    }


    
}