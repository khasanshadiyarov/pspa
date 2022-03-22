<?php

namespace controllers;

class Controller
{
    public $page;

    public function __construct()
    {
        $this->page = isset($_GET['page']) ? $_GET['page'] : null;
    }

    /**
     * Render returned action file by its name
     * @param $view
     * @param array $props
     * @return false|string
     */
    public function render($view, array $props = [])
    {
        ob_start();
        foreach ($props as $key => $prop) {
            ${$key} = $prop;
        }
        $name_arr = explode('\\', get_class($this));
        $name = str_replace('controller', '', strtolower(end($name_arr)));
        require($_SERVER['DOCUMENT_ROOT'] . '/views/' . $name . '/' . $view . '.php');
        return ob_get_clean();
    }

    /** Get action according to the current page
     * @return string
     */
    public function getAction() {
        return 'action' . str_replace(' ', '', ucwords(str_replace('-', ' ', $this->page)));
    }

    /**
     * Call required action method
     * @return mixed
     */
    public function getContent()
    {
        $action = $this->getAction();
        if (method_exists($this, $action)) {
            return $this->$action();
        } else {
            return $this->actionError(404);
        }
    }

    /**
     * Error displaying action
     * @param int $code
     * @return false|string
     */
    public function actionError(int $code = 404)
    {
        /**
         * @var $db
         */

        $title = '';
        $message = '';
        if ($code === 404) {
            $title = 'Page Not Found';
            $message = 'Sorry, this page doesn’t exist <br> or it was moved.';
        } else if ($code === 400) {
            $title = 'Bad request';
            $message = 'Link is incorrect or required parameters <br> missed. Please check it again.';
        } else {
            $title = 'Reconstruction';
            $message = 'Website is under reconstruction working <br> right now, we will finish soon.';
        }

        return $this->render('error', ['code' => $code, 'title' => $title, 'message' => $message]);
    }
}