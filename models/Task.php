<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $name
 * @property int $date
 * @property string $description
 * @property int $user_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $user
 */
class Task extends \yii\db\ActiveRecord
{

    public $events = []; //событие, сгруп. по дням

    public function behaviors()
    {
        return [
            'timestamp1' => [
                'class' => TimestampBehavior::className(),
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'date', 'user_id'], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'date' => 'Дата события',
            'description' => 'Описание',
            'user_id' => 'Создал',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    public function getDaysAndEvents($date = null)
    {

        $keyName = 'events_'.$date;

        $cache = \Yii::$app->cache;
        $data = $cache->get($keyName);

        //проверяем есть ли кеш по ключу 'events'
        //если нет, то записываем результат в кэш
        if($data === false) {

            $daysInMonth = (isset($date)) ? date('t', strtotime($date)) : date('t');

            for ($i=1; $i <= $daysInMonth; $i++) {
                $time = mktime(0,0,0,date('m', strtotime($date)),$i,date('Y', strtotime($date)));
                $this->events[$i] = self::findAll(['date' => $time]);
            }

            $data = $this->events;

            $cache->set($keyName, $data, 30);

        }

        return $data;

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function beforeSave($insert)
    {
        $array = explode('.', $this->date);
        $this->date = mktime(0,0,0,$array[1], $array[0], $array[2]);
        return parent::beforeSave($insert);
    }
}
