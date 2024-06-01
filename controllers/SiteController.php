<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\NewStatement;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if(Yii::$app->user->identity->role_id==1){
            return $this->redirect(['site/panel']);
            }
            else{
                return $this->redirect(['site/statements']);
            }
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionStatements()
    {
        $model = new NewStatement();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Заявление успешно отправлено');
                return $this->redirect(['site/statements']);
            } else {
                Yii::$app->session->setFlash('error', 'Произошла ошибка при отправке заявления.');
            }
        }

        $data = NewStatement::find()
            ->joinWith('statuses')
            ->where(['statements.user_id' => Yii::$app->user->identity->user_id])
            ->all();
        return $this->render('statements', [
            'model' => $model,
            'data' => $data]);
    }

    public function actionPanel()
    {
        $model = new NewStatement();

        if ($model->load(Yii::$app->request->post())) {
            $model2 = NewStatement::findOne(Yii::$app->request->post('NewStatement')['statement_id']);
            $model2->status_id=Yii::$app->request->post('NewStatement')['status_id'];
            if ($model2->save()) {
                Yii::$app->session->setFlash('success', 'Статус успешно изменен');
                return $this->redirect(['site/panel']);
            } else {
                Yii::$app->session->setFlash('error', 'Произошла ошибка при изменении статуса');
            }
        }

        $data = NewStatement::find()
            ->joinWith('statuses')
            ->all();
        return $this->render('panel', [
            'model' => $model,
            'data' => $data]);
    }
}
