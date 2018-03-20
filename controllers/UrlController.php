<?php


namespace app\controllers;


use yii\filters\ContentNegotiator;
use yii\filters\Cors;
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
      /**todo 1.create short url from original
       * todo 2. insert both into DB
       */
      return "This will be the short url of: $long";
   }

}

