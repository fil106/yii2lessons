<?php
/** @var $tasks array */

use yii\bootstrap\Html;
use yii\helpers\Url;

?>

<div class="wrapper">
  <main>
    <div class="toolbar">
      <div class="toggle">
        <!-- <div class="toggle__option">week</div>
        <div class="toggle__option toggle__option--selected">month</div> -->
      </div>
      <div class="current-month"><b><?= date('F Y') ?></b></div>
      <div class="search-input">
        <!-- <input type="text" value="What are you looking for?">
        <i class="fa fa-search"></i> -->
      </div>
    </div>
    <div class="calendar">
      <div class="calendar__header">
        <div>Пн</div>
        <div>ВТ</div>
        <div>СР</div>
        <div>ЧТ</div>
        <div>ПТ</div>
        <div>СБ</div>
        <div>ВС</div>
      </div>

      <?php
      	$day = 0;
      	for ($i=0; $i < 5; $i++) { 
      		echo "<div class=\"calendar__week\">";
      			for($a=0; $a < 7; $a++){
      				$day = ($day > 30) ? 1 : $day+1 ;
      				echo "<div class=\"calendar__day day\">" . $day;
      				echo "</div>";
      			}
      		echo "</div>";
      	}

      ?>
    </div>
  </main>
</div>

<table class="table table-bordered">
	<tr>
		<th>Дата</th>
		<th>Событие</th>
		<th>Всего событий</th>
	</tr>
	<?php foreach($tasks as $day => $events): ?>
		<tr class="td-date">
			<td>
				<span class="label label-success"><?= $day ?></span>
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