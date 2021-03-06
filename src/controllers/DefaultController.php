<?php
namespace mithun\usermanage\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use mithun\usermanage\models\SetPass;
use mithun\usermanage\models\LoginForm;
use mithun\usermanage\models\ForgetForm;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class DefaultController extends Controller
{
    public $layout = "//blank";
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','forgot','reset-password'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionLogin()
    {        
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionForgot()
    {        
        // load post data and send email
        $model = new ForgetForm();
        if ($model->load(Yii::$app->request->post()) && $model->sendForgotEmail()) {
            Yii::$app->session->setFlash("notification", Yii::t("app", "Instructions to reset your password have been sent"));
            return $this->goHome();
        }

        // render
        return $this->render("forgot", [
            "model" => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    public function actionResetPassword($token) {        
        if($model = SetPass::findByPasswordResetToken($token)){
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash("notification", Yii::t("app", "Your have recovered your password. Now you can login"));
                return $this->goHome();
            }

            return $this->render("setpassword", [
                "model" => $model,
            ]);
        }else{
            Yii::$app->session->setFlash("Home-error", Yii::t("app", "Password Recovery Toekn expired!"));
            return $this->goHome();
        }
        
    }
}
