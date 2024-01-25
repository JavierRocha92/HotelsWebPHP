<?php

/**
 * Class to represetn a room from a hotel
 */
class Habitacion {
    /**
     * Class properties
     */

    /**
     * represent room id
     * 
     * @var number
     */
    private $id;

    /**
     * Repressent hotel id
     * 
     * @var number
     */
    private $id_hotel;

    /**
     * Represent number of room
     * 
     * @var number
     */
    private $num_habitacion;

    /**
     * Represetn room type
     * 
     * @var string
     */
    private $tipo;

    /**
     * Represent price of a room
     * 
     * @var number
     */
    private $precio;

    /**
     * Represent description room
     * 
     * @var string
     */
    private $descripcion;

    /**
     * Represent image of a room
     * 
     * @var blob
     */
    private $foto;

    /**
     * Empty constructor (can be omitted if no specific actions are needed)
     */
    function __construct() {
        // You can add initialization logic here if necessary
    }

    /**
     * Magic method __toString to represent the room as a string
     */
    public function __toString() {
        return "Room [ID: {$this->id}, Hotel ID: {$this->hotel_id}, Number: {$this->room_number}, Type: {$this->type}, Price: {$this->price}, Description: {$this->description}]";
    }

    /**
     * Access methods (getters and setters)
     */
    public function getId() {
        return $this->id;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function getId_hotel() {
        return $this->id_hotel;
    }

    public function getNum_habitacion() {
        return $this->num_habitacion;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setId_hotel($id_hotel): void {
        $this->id_hotel = $id_hotel;
    }

    public function setNum_habitacion($num_habitacion): void {
        $this->num_habitacion = $num_habitacion;
    }

    public function setTipo($tipo): void {
        $this->tipo = $tipo;
    }

    public function setPrecio($precio): void {
        $this->precio = $precio;
    }

    public function setDescripcion($descripcion): void {
        $this->descripcion = $descripcion;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function setFoto($foto): void {
        $this->foto = $foto;
    }
}
