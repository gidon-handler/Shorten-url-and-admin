<?php


namespace app\controllers;

use app\models\Urls;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;

class ReController extends Controller
{
    public $modelClass = 'app\models\urls';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::className(),
        ];

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];


        return $behaviors;
    }

    public function actionIndex($short_url)
    {
        $model = new Urls();
        $url = $model->shortCodeToUrl($short_url);
        header("Location: " . "$url");
        exit;

    }

}

