<?php
require __DIR__ . '/../vendor/autoload.php';

$config = array_merge(
    require __DIR__ . '/../config/main.php'
);

(new core\PSPA($config))->run();