<?php
/** @var $tasks array */

use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;

?>

<div class="panel panel-default">
  <div class="panel-body">
	<?= Html::a('Создать событие', Url::to(['task/create']), ['class' => 'btn btn-success']) ?>
    <div class="blk-right">
    	<div class="datepicker-month">
    		<span>Выберите любой день нужного месяца: </span>
	    	<?= DatePicker::widget([
		        'language' => 'ru'
		    ]) ?>
	    	<?= Html::a('Перейти', null, ['class' => 'btn btn-primary ', 'id' => 'sendDate', 'disabled' => 'disabled']) ?>
	    </div>
    </div>
  </div>
</div>

<h1 class="text-center"><?= date('F', strtotime($date)) ?></h1>

<table class="table table-bordered">
	<tr>
		<th>Дата</th>
		<th>Событие</th>
		<th>Всего событий</th>
	</tr>
	<?php foreach($tasks as $day => $events): ?>

		<?php $datel = date('l', strtotime("$day.07.2018")); //день недели ?>

		<tr class="td-date <?= ($datel == 'Sunday' || $datel == 'Saturday') ? 'warning' : null ?>">
			<td>
				<span class="label label-success"><?= $day ?>, <?= $datel ?></span>
			</td>
			<td>
				<?= (count($events) > 0) ? '<p>' . $events[0]->name . '</p><p class="small">' . $events[0]->description . '</p>' : 'Нет событий' ?>
			</td>
			<td class="td-event">
				<?= (count($events) > 0) ? Html::a(count($events), Url::to(['calendar/events', 'date' => $events[0]->date])) : 'Нет событий' ?>
			</td>
		</tr>

	<?php endforeach; ?>
</table>

<script>

	function ready() {

		$('#w0').datepicker( {
			hideIfNoPrevNext: false,
	        changeMonth: true,
	        // changeYear: true,
	        showButtonPanel: true,
	        dateFormat: 'dd.mm.yy',
	        onClose: function(dateText, inst) { 
	            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
	        }
	    });

	    var inputDate = document.getElementById("w0");
	    var btnSend = document.getElementById("sendDate");
	    inputDate.onchange = function() {
	    	btnSend.href = 'http://yii2.loc/index.php?r=calendar&date='+inputDate.value;
	    	btnSend.removeAttribute('disabled');

	    	console.log(inputDate.value);
	    }

	}

	document.addEventListener("DOMContentLoaded", ready);

</script>