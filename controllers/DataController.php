<?php

namespace app\controllers;

use yii\web\Controller;

class DataController extends Controller
{
    public function actionCache()
    {
        $cache = \Yii::$app->cache;
        $mytime = $cache->get('mytime');

        if($mytime === false) {
            $mytime = time();
            $cache->set('mytime', $mytime, 30);
        }

        return $this->render('cache', [
            'mytime' => $mytime
        ]);
    }
}