<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UrlsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Urls';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="urls-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Urls', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'original_url:url',
            'short_url:url',
            'date_created',
            'counter',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
