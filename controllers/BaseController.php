<?php

namespace controllers;

use core\mvc\Controller;

class BaseController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}