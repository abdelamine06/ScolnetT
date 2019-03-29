<?php

/**
 * app de base après l'acces a index.php
 * chargé le controlleur.
 */
class Dispatcher
{
    public $request;

    public function __construct()
    {
        $this->request = new Request();
        Router::parse($this->request->url, $this->request);
        $controller = $this->loadController();
        //appelle a l'action introduite dans la request par un callback comme si faire $controler->view(parms)
        call_user_func_array(array($controller, $this->request->action), $this->request->params);
    }

    /**
     * chargé un controlleur est la premier chose à faire.
     */
    public function loadController()
    {
        //récuperer le nom de controller
        $name = ucfirst($this->request->controller) . 'Controller';
        $file = ROOT . DS . 'controller' . DS . $name . '.php';
        require_once $file;
        return new $name($this->request);
    }
}
