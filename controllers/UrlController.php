<?php


namespace app\controllers;


use app\models\Urls;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\helpers\Url;
use yii\rest\ActiveController;
use yii\web\Response;

class UrlController extends ActiveController
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

   public function actionShortenUrl($long)
   {
      $model = new Urls();
      $code = $model->urlToShortCode($long);
      return Url::base(true)."/re/$code";
   }

}

