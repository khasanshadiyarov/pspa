<?php

try {
    $db = new PDO(
        'mysql:host=127.0.0.1;
        port=3306;
        dbname=geeksonmonitors;
        charset=utf8',
        'root',
        '');
}
catch (Exception $e) {
    return $e->getMessage();
}