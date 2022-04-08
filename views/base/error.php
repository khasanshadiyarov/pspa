<?php
/**
 * @var $this \core\mvc\View
 * @var $exception
 */

$this->title = '#' . $exception->getStatusCode();
?>

<h2>#<?= $exception->getStatusCode() ?></h2>
<p><?= $exception->getMessage() ?></p>
