<?php

namespace core;

use core\mvc\Controller;
use core\route\Route;

class PSPA
{
    public static $app;
    private $config;

    /**
     * Constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * Perform all necessary methods – Run application.
     * @return void
     */
    public function run()
    {
        $this->init();
        $this->show();
    }

    /**
     * Fill out all necessary data in PSPA::$app object.
     * @return void
     */
    public function init()
    {
        self::$app = (object)array(
            'config' => (object)$this->config,
            'route' => (object)(new Route())->getRoute()
        );
    }

    public function show()
    {
        echo (new Controller())->callAction();
    }
}