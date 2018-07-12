<?php
/**
 * Created by PhpStorm.
 * User: fedorov25
 * Date: 12.07.18
 * Time: 10:49
 */

namespace app\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class SecondWidget extends Widget
{
    public function init()
    {
        parent::init();
        ob_start(); // буферизация
    }

    public function run()
    {
        $content = ob_get_clean();
        return '<div>' . $content . '</div>';
    }
}