<?php

//start session
session_start();
//Destroy cookie created by creating session
setcookie(hash('sha256', $user->getId()), 'sessionCookie', time() - 100, '/');
//Destroy Session active
session_destroy();
//Created last visit cookie
setcookie(hash('sha256', $user->getId() . $user->getNombre(), Date('d-m-Y H:m')),'', time() + 3600 * 24, '/');
//Redirect to index and show loign form
header('Location:' . $_SERVER['PHP_SELF'] . 'controller=Usuario&action=showForm');
