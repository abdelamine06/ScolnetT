<?php

/**
 * le controller de base
 * permet de chargé les models
 * permet de chargé les views.
 */
class Controller
{

    /**
     * Permet de rendre ou de charger une vue.
     *
     * @param $view page ou fichier à rendre (chemin depuis view pour page d'erreur ou nom de la vue)
     * @param $data est un tableaux d'arguments passé a la vue
     */
    public function loadView($view, $data = [])
    {
            //inclure les fichiers de la vue
        $file = ROOT . DS . 'view' . DS . $view . '.php';

        require $file;
    }

        /*
     * Permet de charger le model
     * @param  $name nom du model
     */
    public function loadModel($name)
    {
            //inclure le fichier model
        $file = ROOT . DS . 'model' . DS . $name . '.php';
        require_once $file;
            //instancier le model
        return new $name();
    }
}

?>
