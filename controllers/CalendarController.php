<?php

namespace app\controllers;

use app\models\Task;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class CalendarController extends Controller
{
	public function actionIndex($date = null)
	{
		$model = new Task();

		$currDate = isset($date) ? $date : date('j.m.Y');

		$tasks = $model->getDaysAndEvents($currDate);
		return $this->render('index', [
			'tasks' => $tasks,
			'date' => $currDate
		]);

	}

	public function actionEvents($date)
	{
		$dataProvider = new ActiveDataProvider([
			'query' => Task::find()->where(['date' => $date]),
			'pagination' => [
				'pageSize' => 1
			]
		]);

		return $this->render('events', [
			'dataProvider' => $dataProvider,
			'date' => date('j.m.Y', $date)
		]);
	}
}