<?php
/**
 * @var \core\mvc\View $this
 * @var $content
 */

use assets\BaseAsset;

$asset = new BaseAsset();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $this->title ?></title>
    <?= $asset->_head ?>
</head>
<body>
<h1>Chikotka</h1>
<?= $content ?>
<?= $asset->_body ?>
</body>
</html>
