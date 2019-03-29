<?php

/**
 * permet d'Avoir l'url tapé par l'utilisateur.
 */
class Request
{
    public $url;

    public function __construct()
    {
        if (isset($_SERVER['PATH_INFO'])) {
            $this->url = $_SERVER['PATH_INFO'];
        }else{
            $this->url = '/users/home';
        } 

    }
}
