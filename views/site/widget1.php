<?php

use app\widgets\FirstWidget;

?>

<?= FirstWidget::widget() ?>

<?= FirstWidget::widget([
    'message' => 'Тестовое сообщение'
]) ?>

