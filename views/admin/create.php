<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Urls */

$this->title = 'Create Urls';

?>
<div class="urls-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
