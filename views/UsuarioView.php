<?php
class UsuarioView{
    function showUsers($allUsers){
        foreach ($allUsers as $user) {
            echo "$user<br>";
        }
    }
}
