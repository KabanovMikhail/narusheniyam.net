<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\RegUser;

class RegistrationController extends Controller
{
    public function actionRegister()
    {
        $model = new RegUser();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->password = Yii::$app->security->generatePasswordHash($model->password);
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Регистрация прошла успешно.');
                return $this->redirect(['site/registration']);
            } else {
                Yii::$app->session->setFlash('error', 'Произошла ошибка при регистрации.');
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }
}