<?php
require './views/ReservaView.php';
require './models/ReservaModel.php';

class ReservaController{
    function __construct(){
        $this->reservaView = new ReservaView();
        $this->reservaModel = new ReservaModel();
    }
    function listReservas(){
        $allBookings = $this->reservaModel->getReservas();
        $this->reservaView->showReservas($allBookings);
    }
}
