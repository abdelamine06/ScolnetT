<?php

/**
 * Permet de parser ou de décomposer l'url a trois argument /Controller/Action/Params.
 */
class Router
{
    /**
     * decoupé l'url récuperer en Controller/action/params.
     */
    public static function parse($url, $request)
    {
        //enlever les "/" au debut et à la fin de l'url
        $url = trim($url, '/');
        // filtrer l'url pour ne pas avoir d'autres caractere spécieaux ou autres que ceux d'une url
        $url = filter_var($url, FILTER_SANITIZE_URL); 
        //decomposé la chaine en un array par un /
        $args = explode('/', $url);
        $request->controller = $args[0];
        $request->action = isset($args[1]) ? $args[1] : 'home';
        $request->params = array_slice($args, 2);
        return true;
    }
}
