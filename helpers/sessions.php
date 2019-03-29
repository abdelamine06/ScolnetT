<?php 
    function createUserSession($user)
    {
       session_start();
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
    }


 
