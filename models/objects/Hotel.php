<?php

//
//class Hotel{
//    private $id;
//    private $nombre;
//    private $direccion;
//    private $ciudad;
//    private $pais;
//    private $num_habitaciones;
//    private $descripcion;
//    private $foto;
//    
//
//   function __construct(){
//        
//   }
//    
//    public function __toString() {
//        return "Hotel: {$this->nombre}\nID: {$this->id}\nDirección: {$this->direccion}\nCiudad: {$this->ciudad}\nPaís: {$this->pais}\nNúmero de habitaciones: {$this->num_habitaciones}\nDescripción: {$this->descripcion}\nFoto: {$this->foto}";
//    }
//    
//    public function getId() {
//        return $this->id;
//    }
//
//    public function getNombre() {
//        return $this->nombre;
//    }
//
//    public function getDireccion() {
//        return $this->direccion;
//    }
//
//    public function getCiudad() {
//        return $this->ciudad;
//    }
//
//    public function getPais() {
//        return $this->pais;
//    }
//
//    public function getNum_habitaciones() {
//        return $this->num_habitaciones;
//    }
//
//    public function getDescripcion() {
//        return $this->descripcion;
//    }
//
//    public function getFoto() {
//        return $this->foto;
//    }
//
//    public function setId($id): void {
//        $this->id = $id;
//    }
//
//    public function setNombre($nombre): void {
//        $this->nombre = $nombre;
//    }
//
//    public function setDireccion($direccion): void {
//        $this->direccion = $direccion;
//    }
//
//    public function setCiudad($ciudad): void {
//        $this->ciudad = $ciudad;
//    }
//
//    public function setPais($pais): void {
//        $this->pais = $pais;
//    }
//
//    public function setNum_habitaciones($num_habitaciones): void {
//        $this->num_habitaciones = $num_habitaciones;
//    }
//
//    public function setDescripcion($descripcion): void {
//        $this->descripcion = $descripcion;
//    }
//
//    public function setFoto($foto): void {
//        $this->foto = $foto;
//    }
//
//
//    
//}

/**
 * Class to represent hotel
 */
class Hotel {

    /**
     * Class properties
     */
    private $id;                  // Unique identifier for the hotel
    private $nombre;              // Name of the hotel
    private $direccion;           // Address of the hotel
    private $ciudad;              // City where the hotel is located
    private $pais;                // Country where the hotel is located
    private $num_habitaciones;    // Number of rooms in the hotel
    private $descripcion;         // Description of the hotel
    private $foto;                // Photo of the hotel

    /**
     * Constructor
     */
    function __construct() {
        
    }

    /**
     * Magic method __toString to represent the hotel as a string
     */
    public function __toString() {
        return "Hotel: {$this->nombre}\nID: {$this->id}\nDirección: {$this->direccion}\nCiudad: {$this->ciudad}\nPaís: {$this->pais}\nNúmero de habitaciones: {$this->num_habitaciones}\nDescripción: {$this->descripcion}\nFoto: {$this->foto}";
    }

    /**
     * Getter and setter methods
     */
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

    public function getNum_habitaciones() {
        return $this->num_habitaciones;
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

    public function setNum_habitaciones($num_habitaciones): void {
        $this->num_habitaciones = $num_habitaciones;
    }

    public function setDescripcion($descripcion): void {
        $this->descripcion = $descripcion;
    }

    public function setFoto($foto): void {
        $this->foto = $foto;
    }
}
