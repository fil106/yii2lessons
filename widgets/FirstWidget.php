<?php
/**
 * Created by PhpStorm.
 * User: fedorov25
 * Date: 12.07.18
 * Time: 10:35
 */

namespace app\widgets;

use yii\base\Widget;
use yii\helpers\Html;


class FirstWidget extends Widget
{
    public $message; //Свойство настраиваемое

    /**
     * Вызывается первым
     * инициализация виджета
     * Обычно здесь задают значения параметров по умолчанию
     */
    public function init()
    {
        parent::init();
        if($this->message === null) {
            $this->message = 'Значение по умолчанию';
        }
    }

    /**
     * Метод генерирует и возвращает HTML код для вывода
     *
     * @return string html код для вывода
     */
    public function run()
    {
        return '<h1>' . Html::encode($this->message) . '</h1>';
    }

}