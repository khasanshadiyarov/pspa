<?php

namespace core\mvc;

use core\exceptions\BadRequestHttpException;
use core\exceptions\NotFoundHttpException;
use core\PSPA;
use Exception;
use ReflectionMethod;

class Controller
{
    public $_view;

    /**
     * Render view content and trigger layout rendering.
     * @param $view
     * @param $params
     * @return false|string
     */
    public function render($view, $params = [])
    {
        $content = $this->getView()->render($view, $params);
        return $this->renderContent($content);
    }

    /**
     * Render base or selected layout and pass the view content.
     * @param $content
     * @return false|string
     */
    public function renderContent($content)
    {
        return $this->getView()->renderFile($this->getView()->getLayoutPath(), ['content' => $content]);
    }

    /**
     * Call required action method.
     * @return mixed
     */
    public function callAction()
    {
        $controllerClass = $this->getControllerClass();
        $action = $this->getControllerAction();
        $paramsPass = [];

        try {
            if (class_exists($controllerClass) && $action) {
                $controllerObj = new $controllerClass();
                // Check if the controller contains the required action
                if (method_exists($controllerObj, $action)) {
                    // Assign action's parameters according to GET parameters
                    $ref = new ReflectionMethod($controllerObj, $action);
                    $params = $ref->getParameters();
                    foreach ($params as $param) {
                        if (isset($_GET[$param->getName()]) && $_GET[$param->getName()]) {
                            $paramsPass[] = $_GET[$param->getName()];
                        } else {
                            if (!$param->isOptional()) {
                                throw new BadRequestHttpException('Missing required parameter: <b>' . $param->getName() . '</b>');
                            }
                        }
                    }
                    // Controller and action coincide and exist
                    return $controllerObj->$action(...$paramsPass);
                }
            }
            // Page not found
            throw new NotFoundHttpException('Sorry, this page does not exist or it was moved.');
        } catch (Exception $e) {
            return $this->actionError($e);
        }
    }

    /**
     * Create View class object and save it for further usage.
     * @return View
     */
    public function getView()
    {
        if (!$this->_view) {
            $this->_view = new View();
        }

        return $this->_view;
    }

    /**
     * Get namespace of the requested controller.
     * @return string
     */
    public function getControllerClass()
    {
        return '\controllers\\' . ucfirst(PSPA::$app->route->controller) . 'Controller';
    }

    /**
     * Get action method name of the requested action.
     * @return string
     */
    public function getControllerAction()
    {
        return 'action' . ucfirst(PSPA::$app->route->action);
    }

    /**
     * Error displaying action.
     * @return false|string
     */
    public function actionError($exception = null)
    {
        return $this->render(PSPA::$app->config->errorHandler, ['exception' => $exception]);
    }
}