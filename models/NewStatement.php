<?php
namespace app\models;

use yii\db\ActiveRecord;

class NewStatement extends ActiveRecord
{
    public static function tableName()
    {
        return 'statements'; // Имя таблицы в базе данных
    }

    public function getStatuses()
    {
        return $this->hasOne(Statuses::className(), ['status_id' => 'status_id']);
    }

    public function rules()
    {
        return [
            [['number', 'description'], 'required', 'message' => 'Пожалуйста, заполните это поле.'],
            [['user_id'], 'required'],
        ];
    }
}