<?php
namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class AuthUser extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'users'; // Имя таблицы в базе данных
    }

    // Реализация методов интерфейса IdentityInterface
    public static function findIdentity($user_id)
    {
        return static::findOne($user_id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // Метод не используется в данном примере
        return null;
    }

    public function getId()
    {
        return $this->user_id;
    }

    public function getAuthKey()
    {
        // Метод не используется в данном примере
        return null;
    }

    public function validateAuthKey($authKey)
    {
        // Метод не используется в данном примере
        return false;
    }

    // Добавьте метод для поиска пользователя по логину
    public static function findByLogin($login)
    {
        return static::findOne(['login' => $login]);
    }

    // Добавьте метод для проверки пароля
    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }
}