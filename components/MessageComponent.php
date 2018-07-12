<?php

namespace app\components;

use yii\base\Component;
use yii\helpers\Html;

class MessageComponent extends Component
{
    public $content; //настраиваемый

    public function init()
    {
        parent::init();
        $this->content = 'Текст по умолчанию';
    }

    /**
     * Пользовательский метод
     *
     * @param null $content Содержимое для отображения
     */
    public function display($content = null)
    {
        if($content !== null) {
            $this->content = $content;
        }

        echo Html::encode($this->content);
    }


}