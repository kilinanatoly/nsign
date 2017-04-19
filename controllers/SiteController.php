<?php

namespace app\controllers;

use app\models\Ingridients;
use app\models\IngridientsForProducts;
use app\models\Products;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
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
        $allIngridients = Ingridients::find()->where('active = 1')->all();
        if (Yii::$app->request->post()){

            if (count(Yii::$app->request->post('ingridient'))<2 || !(Yii::$app->request->post('ingridient'))){
                Yii::$app->getSession()->setFlash('message','<div class="alert alert-danger">Выберите больше ингредиентов</div>');
                return $this->redirect('/');
            }
            $findProducts = [];
            foreach (Yii::$app->request->post('ingridient') as $key=>$value ) {
                $find = IngridientsForProducts::find()
                    ->innerJoinWith('product')
                    ->innerJoinWith('ingridient')
                    ->where('ingridients_for_products.ingridient_id = '.$value.' AND ingridients.active = 1')
                    ->all();

                foreach ($find as $key2 => $value2) {
                    $findProducts[$value2->product_id]['ingridients'][] = $value2->ingridient_id;
                    $findProducts[$value2->product_id]['product'] = $value2->product;
                }
            }
            $totalResult = [];
            //сбрасываем ключи
            $findProducts = array_values($findProducts);
            //сортируем в порядке убывания пузырьковым методом
            $t = true;
            while($t){ //циклим пока есть чего
                $t = false;
                for($i = 0; $i < count($findProducts) - 1; $i++){
                    if (count($findProducts[$i]['ingridients']) < count($findProducts[$i + 1]['ingridients'])){
                        $temp = $findProducts[$i + 1];
                        $findProducts[$i + 1] = $findProducts[$i];
                        $findProducts[$i] = $temp;
                        $t = true;
                    }
                }
            }

            //проверка на полное совпадение ингридиентов
            foreach ($findProducts as $key => $value) {
                if (count($value['ingridients'])!=count(Yii::$app->request->post('ingridient'))){
                    break;
                }
                $totalResult[] = $value;
            }

            if (!$totalResult){
                foreach ($findProducts as $key => $value) {
                    if (count($value['ingridients'])<2){
                        continue;
                    }
                    $totalResult[] = $value;
                }
            }

            return $this->render('index',[
                'allIngridients'=>$allIngridients,
                'findProducts'=>$totalResult,
                'currentIngridients'=>Yii::$app->request->post('ingridient')
            ]);



        }
        return $this->render('index',[
            'allIngridients'=>$allIngridients,
            'findProducts'=>[],
            'currentIngridients'=>[]
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
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
}
