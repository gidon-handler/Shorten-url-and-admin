<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Urls */

$this->title = 'Update Url';

?>
<div class="urls-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
