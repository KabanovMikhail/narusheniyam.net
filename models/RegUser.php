<?php
namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class RegUser extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'users'; // Имя таблицы в базе данных
    }

    public function rules()
    {
        return [
            [['login', 'password', 'fio', 'tel', 'email'], 'required', 'message' => 'Пожалуйста, заполните это поле.'],
            [['login', 'password', 'fio', 'tel', 'email'], 'string', 'max' => 255],
            ['email', 'email'],
            ['login', 'unique','message' => 'Логин уже занят'],
            ['email', 'unique','message' => 'Пароль уже занят'],
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // Если у вас есть поле токена, используйте его для поиска пользователя
        // Например:
        // return static::findOne(['access_token' => $token]);
        return null;
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        // Если у вас есть поле auth_key, верните его значение
        // Например:
        // return $this->auth_key;
        return null;
    }

    public function validateAuthKey($authKey)
    {
        // Если у вас есть поле auth_key, проверьте, соответствует ли его значение $authKey
        // Например:
        // return $this->getAuthKey() === $authKey;
        return false;
    }

    // Другие методы, такие как validatePassword(), и т.д.
}
