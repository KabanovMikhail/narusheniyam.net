<?php
namespace app\models;

use yii\db\ActiveRecord;

class Statuses extends ActiveRecord
{
    public static function tableName()
    {
        return 'statuses'; // Имя таблицы в базе данных
    }

    public function getNewStatemens()
    {
        return $this->hasOne(NewStatement::className(), ['status_id' => 'status_id']);
    }
    public function getNewStatus()
    {
        return $this->hasOne(NewStatus::className(), ['status_id' => 'status_id']);
    }
}