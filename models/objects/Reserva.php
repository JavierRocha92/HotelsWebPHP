<?php

/**
 * Class to represent a room booking
 */
class Reserva {

    /**
     * Class properties
     */
    private $id;               // Unique identifier for the reservation
    private $id_usuario;       // User ID associated with the reservation
    private $id_hotel;         // Hotel ID where the reservation is made
    private $id_habitacion;    // Room ID for the reserved room
    private $fecha_entrada;    // Entry date for the reservation
    private $fecha_salida;     // Exit date for the reservation

    /**
     * Constructor
     */
    function __construct() {
        
    }

    /**
     * Magic method __toString to represent the reservation as a string
     */
    public function __toString() {
        return "Reserva ID: {$this->id}\nUsuario ID: {$this->id_usuario}\nHotel ID: {$this->id_hotel}\nHabitación ID: {$this->id_habitacion}\nFecha de entrada: {$this->fecha_entrada}\nFecha de salida: {$this->fecha_salida}";
    }

    /**
     * Getter methods
     */
    public function getId() {
        return $this->id;
    }

    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function getId_hotel() {
        return $this->id_hotel;
    }

    public function getId_habitacion() {
        return $this->id_habitacion;
    }

    public function getFecha_entrada() {
        return $this->fecha_entrada;
    }

    public function getFecha_salida() {
        return $this->fecha_salida;
    }

    /**
     * Setter methods
     */
    public function setId($id): void {
        $this->id = $id;
    }

    public function setId_usuario($id_usuario): void {
        $this->id_usuario = $id_usuario;
    }

    public function setId_hotel($id_hotel): void {
        $this->id_hotel = $id_hotel;
    }

    public function setId_habitacion($id_habitacion): void {
        $this->id_habitacion = $id_habitacion;
    }

    public function setFecha_entrada($fecha_entrada): void {
        $this->fecha_entrada = $fecha_entrada;
    }

    public function setFecha_salida($fecha_salida): void {
        $this->fecha_salida = $fecha_salida;
    }
}
