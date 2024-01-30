<?php

function getErrorMessage($code) {
    switch ($code) {

        case 1049 :
            return "Lo sentimos, hubo un problema al acceder a la base de datos. Por favor, inténtalo de nuevo más tarde.";
        case 42000:
            return "Lo sentimos, ocurrió un error al procesar tu solicitud. Por favor, contacta al soporte técnico para obtener ayuda.";
        case 23000:
            return "Error al recuperar la información de las reservas. Por favor, intenta nuevamente más tarde.";
        case 2002 :
            return "La aplicación esta en labores de mantenimineto, intentelo mas tarde";
        case '21S01':
            return "La fecha de salida debe de ser posterior a la de entrada.";
        case 0001:
            return "Por favor, asegúrate de ingresar las fechas de reserva de manera correcta. La fecha de salida debe ser posterior a la fecha de entrada, y la fecha de entrada debe ser al menos el día de hoy. Esto garantizará una reserva válida. Gracias por tu cooperación.";
        default:
            return 'La aplicación esta en labores de mantenimiento, disculpe las molestias.';
    }
}

function showDatabaseError($data) {
    ?>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Disculpe las molestias.</h5>
        </div>
        <div class="card-body">
            <p class="card-text"><?= getErrorMessage($data['code']) ?>.</p>
            <a href="<?= $_SERVER['PHP_SELF'] . '?controller=Usuario&action=logOut' ?>" class="btn btn-primary">Volver</a>
        </div>
    </div>
    <?php
}
