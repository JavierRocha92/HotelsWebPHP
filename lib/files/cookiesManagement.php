<?php
//Conditional to set specidif value for cookieSession variable from $_COOKIE values from any user
$cookieSession = isset($_COOKIE[hash('sha256',$user->getId())]) ? $_COOKIE[hash('sha256',$user->getId())] : null;
//Condtitional to check if alst visit cookie exist for any user
$cookieLastVisit = isset($_COOKIE[hash('sha256',$user->getId()).$user->getNombre()]) ? $_COOKIE[hash('sha256',$user->getId().$user->getNombre())] : null;

if($cookieSession == null){
     //Erase cookie session newly destroyed
    setcookie(session_id(),'sessionCookie',time() -100,'/');
    //Destroy session active
    session_destroy();
    //Require to log user out
    require_once 'logOut.php';
    //Calling logOut function 
    header('Location:'.$_SERVER['PHP_SELF'].'?controller=Usuario&action=logOut');
}



