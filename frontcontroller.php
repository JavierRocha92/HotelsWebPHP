<?php

include_once './controllers/HotelController.php';
include_once './controllers/HabitacionController.php';
include_once './controllers/ReservaController.php';
include_once './controllers/UsuarioController.php';

// Define la acción por defecto
define('DEFAULT_ACTION', 'getForm');
// Define el controlador por defecto
define('DEFAULT_CONTROLLER', 'Usuario');

// Comprueba la acción a realizar, que llegará en la petición.
// Si no hay acción a realizar lanzará la acción por defecto, que es listar
// Y se carga la acción, llama a la función cargarAccion
function throwAction($controllerObj) {

    if (isset($_GET["action"]) && method_exists($controllerObj,
                    $_GET["action"])) {
        loadAction($controllerObj, $_GET["action"]);
    } else {
        loadAction($controllerObj, DEFAULT_ACTION);
//O añadir una página indicando el error de la acción
//die("Se ha cargado una acción errónea");
    }
}

// Lo que hace es ejecutar una función que va a existir en el controlador
// y que se llama como la acción. Recibe un objeto controlador.
function loadAction($controllerObj, $action) {
    $accion = $action;
    $controllerObj->$accion();
}

// Carga el controlador especificado y devuelve una instancia del mismo
function loadController($controllerName) {
    $controller = $controllerName . 'Controller';
    if (class_exists($controller)) {
        return new $controller();
    } else {
// Si el controlador no existe, se lanza una excepción
//O añadir una página indicando el error del controlador
        die("controlador no válido");
    }
}

// Carga el controlador y la acción correspondientes
if (isset($_GET["controller"])) {
    
//    if($_GET['controller'] != 'Usuario' && $_GET['action'] != 'logIn'){
//        require_once './lib/files/sessionManagement.php';
//    require_once './lib/files/cookiesManagement.php';
//    }
    
    $controllerObj = loadController($_GET["controller"]);
    throwAction($controllerObj);
} else {
    $controllerObj = loadController(DEFAULT_CONTROLLER);
    throwAction($controllerObj);
}
