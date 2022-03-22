<?php
namespace controllers;

require 'Controller.php';

use controllers\Controller;

class SiteController extends Controller
{
    public $title;
    public $description;

    public function __construct()
    {
        parent::__construct();
        $this->title = $_SERVER['REQUEST_URI'];
        $this->description = '';
    }

    public function actionIndex() {
        $this->title = 'Home title';
        return $this->render('index');
    }

    public function actionAbout() {
        $this->title = 'About title';
        return $this->render('about');
    }
}