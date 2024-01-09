<?php
class HabitacionController{
    function __contruct(){
        $this->habitacionView = new HabitacionView();
        $this->habitacionModel = new HabitacionModel();
    }
}

