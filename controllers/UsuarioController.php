<?php
require './views/UsuarioView.php';
require './models/UsuarioModel.php';

class UsuarioController{
    function __construct(){
        $this->usuarioView = new UsuarioView();
        $this->usuarioModel = new UsuarioModel();
    }
    
    function listUsuarios(){
        $allUsers = $this->usuarioModel->getUsuarios();
        $this->usuarioView->showUsers($allUsers);
    }
}
