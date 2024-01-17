<?php
//Start session
session_start();
//Create Usuario object by taking values from $_SESSION['user'] or null if this variables does not exist
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
$user = unserialize($user);
//Conditional to check if user is set
if($user == null){
    echo 'estro porque el usuario no existe';
    //Redirect and show form again to user to login 
    header('Location: '.$_SERVER['PHP_SELF']);
}
