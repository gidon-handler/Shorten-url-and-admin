<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Urls */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="urls-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'original_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_url')->textInput() ?>

    <?= $form->field($model, 'date_created')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'counter')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
