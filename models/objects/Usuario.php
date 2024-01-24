<?php

/**
 * Class to represent a user for app hotels
 */
class Usuario {

    /**
     * Class properties
     */
    private $id;                // Unique identifier for the user
    private $nombre;            // User's name
    private $contraseña;        // User's password
    private $fecha_registro;    // Date of user registration
    private $rol;               // User role

    /**
     * Constructor
     */
    function __construct() {
        
    }

    /**
     * Magic method __toString to represent the user as a string
     */
    public function __toString() {
        return "Usuario ID: {$this->id}\nNombre: {$this->nombre}\nFecha de registro: {$this->fecha_registro}\nRol: {$this->rol}";
    }

    /**
     * Getter methods
     */
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getContraseña() {
        return $this->contraseña;
    }

    public function getFecha_registro() {
        return $this->fecha_registro;
    }

    public function getRol() {
        return $this->rol;
    }

    /**
     * Setter methods
     */
    public function setId($id): void {
        $this->id = $id;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function setContraseña($contraseña): void {
        $this->contraseña = $contraseña;
    }

    public function setFecha_registro($fecha_registro): void {
        $this->fecha_registro = $fecha_registro;
    }

    public function setRol($rol): void {
        $this->rol = $rol;
    }
}
