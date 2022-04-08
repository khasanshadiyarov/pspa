<?php

namespace core\route;

use core\exceptions\NotFoundHttpException;
use core\mvc\Controller;
use Exception;

class Route
{
    public $route;

    /**
     * ...
     * @return false|string|void
     */
    public function getRoute()
    {
        $ca = isset($_GET['ca']) ? explode('/', $_GET['ca']) : null;
        $c = new Controller();
        try {
            if (count($ca) > 1) {
                $this->route['controller'] = $ca[0];
                $this->route['action'] = $ca[1];

                return $this->route;
            } else {
                throw new NotFoundHttpException('Sorry, this page does not exist or it was moved.');
            }
        } catch (Exception $e) {
            return $c->actionError($e);
        }
    }
}