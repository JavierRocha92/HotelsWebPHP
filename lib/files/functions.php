<?php

function getErrorMessage($code) {
    switch ($code) {

        case 1049 :
            return "Lo sentimos, hubo un problema al acceder a la base de datos. Por favor, inténtalo de nuevo más tarde.";
        case 42000:
            return "Lo sentimos, ocurrió un error al procesar tu solicitud. Por favor, contacta al soporte técnico para obtener ayuda.";
        case 23000:
            return "Error al recuperar la información de las reservas. Por favor, intenta nuevamente más tarde.";
        case 2002:
            return "Lo sentimos, hubo un problema al acceder a la base de datos. Por favor, inténtalo de nuevo más tarde.";
    }
}

function showError($data) {
    ?>
    <p><?= getErrorMessage($data['code']) ?></p>
    <?php
}

//PDOException (Errores generales de la base de datos):
//
//Mensaje: "Lo sentimos, hubo un problema al acceder a la base de datos. Por favor, inténtalo de nuevo más tarde."
//Este mensaje es genérico y no proporciona detalles específicos sobre la naturaleza del error, lo cual es una buena práctica para no exponer información sensible al usuario.
//PDOException (prepare/execute):
//
//Mensaje: "Lo sentimos, ocurrió un error al procesar tu solicitud. Por favor, contacta al soporte técnico para obtener ayuda."
//Al igual que en el caso anterior, este mensaje es genérico y sugiere al usuario que se comunique con el soporte técnico para obtener asistencia adicional.
//PDOException (fetchAll):
//
//Mensaje: "Error al recuperar la información de las reservas. Por favor, intenta nuevamente más tarde."
//Nuevamente, se proporciona un mensaje genérico sin detalles específicos.
//Exception (fallback):
//
//Mensaje: "Ocurrió un error inesperado. Por favor, contacta al soporte técnico para obtener asistencia."
//Este mensaje abarca cualquier excepción no manejada y sugiere al usuario que se comunique con el soporte técnico para obtener ayuda.











//function sessionManagement($_SESSION) {
//    //Start session
//    session_start();
////Create Usuario object by taking values from $_SESSION['user'] or null if this variables does not exist
//    $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
////Conditional to check if user is set
//    if (!isset($user)) {
//        //Redirect and show form again to user to login 
//        header('Location: ' . $_SERVER['PHP_SELF'] . '?controller=Usuario&action=showForm');
//    }
//}
//
//function cookieManagement($_COOKIE) {
//    //Conditional to set specidif value for cookieSession variable from $_COOKIE values from any user
//    $cookieSession = isset($_COOKIE[hash('sha256', $user->getId())]) ? $_COOKIE[hash('sha256', $user->getId())] : null;
////Condtitional to check if alst visit cookie exist for any user
//    $cookieLastVisit = isset($_COOKIE[hash('sha256', $user->getId()) . $user->getNombre()]) ? $_COOKIE[hash('sha256', $user->getId() . $user->getNombre())] : null;
//}
