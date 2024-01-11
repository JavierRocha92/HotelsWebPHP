<?php

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
