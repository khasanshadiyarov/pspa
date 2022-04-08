<?php

namespace core\mvc;

use core\exceptions\NotFoundHttpException;
use core\PSPA;
use Exception;

class View
{
    public $title;
    public $keywords;
    public $description;
    public $layout;

    /**
     * Constructor. Assign base or selected layout.
     * @param $layout
     */
    public function __construct($layout = null)
    {
        $this->layout = $layout ? $layout : PSPA::$app->config->layout;
    }

    /**
     * Render view file.
     * @param $view
     * @param array $props
     * @return false|string
     */
    public function render($view, array $props = [])
    {
        $controller = PSPA::$app->route->controller;
        // Check if controller is specified
        if (strpos($view, '/')) {
            $ca = explode('/', $view);
            $controller = $ca[0];
            $view = $ca[1];
        }
        $path = $this->getViewPath($controller, $view);
        return $this->renderFile($path, $props);
    }

    /**
     * Render a specific file and pass props.
     * @param $path
     * @param $props
     * @return false|string
     */
    public function renderFile($path, $props = [])
    {
        ob_start();
        // Check if file exists
        try {
            if (!file_exists($path)) {
                // File doesn't exist
                throw new NotFoundHttpException('Sorry, this page does not exist or it was moved.');
            }
        } catch (Exception $e) {
            // Rewrite path to error handler
            $path = $this->getErrorPath();
            $props = ['exception' => $e];
        }
        foreach ($props as $key => $prop) {
            ${$key} = $prop;
        }
        require $path;
        return ob_get_clean();
    }

    /**
     * Get view file path.
     * @param $controller
     * @param $view
     * @return string
     */
    public function getViewPath($controller, $view)
    {
        return $_SERVER['DOCUMENT_ROOT'] . '/views/' . $controller . '/' . $view . '.php';
    }

    /**
     * Get layout file path.
     * @return string
     */
    public function getLayoutPath()
    {
        return $_SERVER['DOCUMENT_ROOT'] . '/web/layouts/' . $this->layout . '.php';
    }

    public function getErrorPath()
    {
        return $_SERVER['DOCUMENT_ROOT'] . '/views/' . PSPA::$app->config->errorHandler . '.php';
    }
}