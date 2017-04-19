<?php

namespace app\modules\admin\controllers;

use app\models\Catalog;
use app\models\CompanyBalance;
use app\models\Functions;
use app\models\Orders;
use app\models\VyvodRequests;
use app\modules\lc\models\UserBuyHistory;
use budyaga\users\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;

/**
 * Default controller for the `lc` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public $layout = 'admin';
    public function actionIndex()
    {
        return $this->render('index',[
        ]);
    }
}
