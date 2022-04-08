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
    <meta name="description" content="<?= $this->description ?>">
    <meta name="description" content="<?= $this->keywords ?>">
    <?= $asset->_head ?>
</head>
<body>
<?= $content ?>
<?= $asset->_body ?>
</body>
</html>
