<?php
/** @car $dataProvider \yii\data\ActiveDataProvider */
use yii\helpers\Html;
use yii\widgets\ListView;
?>

<div>
	<h1>Событие календаря на <?= Html::encode($date) ?></h1>
	<?= ListView::widget([
		'dataProvider' => $dataProvider,
		'itemView' => '_event'
	]) ?>
</div>