<?php

require './views/UsuarioView.php';
require './models/UsuarioModel.php';

class UsuarioController {

    function __construct() {
        $this->usuarioView = new UsuarioView();
        $this->usuarioModel = new UsuarioModel();
    }

    function listUsuarios() {
        $allUsers = $this->usuarioModel->getUsuarios();
        $this->usuarioView->showUsers($allUsers);
    }

    function getForm() {
        $this->usuarioView->showForm();
    }

    function checkCredentials() {
//Conditional to check if variables form post exist
        if (isset($_POST['username']) && isset($_POST['password'])) {
//Filtering values
            $postValues = filter_input_array(INPUT_POST, $_POST);
            //Convert password by hash function
            $postValues['password'] = hash('sha256', $postValues['password']);
            echo $postValues['password'];
//Calling function to check if user exist in database
            if ($this->usuarioModel->existsInDb('nombre', $postValues['username'], 'Usuarios')) {
                //Create new user object by calling function to get a user if password and username match
                $user = $this->usuarioModel->getUser($postValues['username'], $postValues['password']);
                echo 'Este es el usuario creado<br>';
                echo $user;
//Conditional to check is user has values
                if ($user) {
                    echo 'la contraseña y el nombre sel usuario coinciden';
                    //return user object newly created
                    $this->createSessionUser($user);
                    header('Location:' . $_SERVER['PHP_SELF'].'?controller=Hotel&action=listHotels');
                } else {
//Mostrar un mensaje de error cuando la contraseña no coincida con la del user facilitado
                }
            } else {
//mostar mensaje de error cuando el usuario no se encuentre en la base de datos
            }
        }
    }

    function createSessionUser($user) {
        session_start();
        $_SESSION['user'] = serialize($user);
    }
}
