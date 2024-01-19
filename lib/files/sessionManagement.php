<?php

require_once './models/objects/Usuario.php';

//Start session
session_start();
//Create Usuario object by taking values from $_SESSION['user'] or null if this variables does not exist
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
global $user;
if (isset($user)) {
    $user = unserialize($user);
    $_SESSION['username'] = $user->getNombre();
}

//Conditional to check if user is set
if ($user == null) {
    //Conditinal to check if $_GET is set
    if (count($_GET) > 1) {
        $getValues = filter_input_array(INPUT_GET, $_GET);
        if ($getValues['controller'] != 'Usuario' && ($getValues['action'] != 'getForm') || $getValues['action'] != 'logIn') {
            //Redirect and show form again to user to login 
            header('Location: ' . $_SERVER['PHP_SELF']);
        }
    }
}
