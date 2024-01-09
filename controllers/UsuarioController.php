<?php
class UsuarioController{
    function __construct(){
        $this->usuarioView = new UsuarioView();
        $this->usuarioModel = new UsuarioModel();
    }
}
