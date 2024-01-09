<?php
class ReservaController{
    function __construct(){
        $this->reservaView = new ReservaView();
        $this->reservaModel = new ReservaModel();
    }
}
