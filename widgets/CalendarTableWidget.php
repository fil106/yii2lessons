<?php

namespace app\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;


class CalendarTableWidget extends Widget
{
    public $classNames;
    public $tasks;

    private $tableHtml;

    public function init()
    {
        parent::init();
        if($this->classNames === null) {
            $this->classNames = '';
        }
    }

    public function run()
    {
        $this->generateTable($this->classNames);

        return $this->tableHtml;
    }

    protected function generateTable($classNames = null)
    {
        $this->tableHtml = '<table class="table ' . Html::encode($classNames) . '">';
        $this->tableHtml .= '
            <tr>
                <th>Дата</th>
                <th>Событие</th>
                <th>Всего событий</th>
            </tr>
        ';
        $this->generateRows($this->tasks);
        $this->tableHtml .= '</table>';
    }

    private function generateRows($tasks = null)
    {
        foreach($tasks as $day => $events) {

            $datel = date('l', strtotime("$day.07.2018")); //день недели
            $trClassName = ($datel == 'Sunday' || $datel == 'Saturday') ? 'warning' : null; //класс для tr если выходной то добавляем класс
            $eventDescription = (count($events) > 0) ? '<p>' . $events[0]->name . '</p><p class="small">' . $events[0]->description . '</p>' : 'Нет событий';
            $eventsCount = (count($events) > 0) ? Html::a(count($events), Url::to(['calendar/events', 'date' => $events[0]->date])) : 'Нет событий';

            $rowsHtml = "<tr class=\"td-date " . $trClassName . "\">
                <td>
                    <span class=\"label label-success\">" . $day . "," . $datel . "</span>
                </td>
                <td>" . $eventDescription . "</td>
                <td class=\"td-event\">" . $eventsCount . "</td>
            </tr>";

            $this->tableHtml .= $rowsHtml;

        }
    }

}