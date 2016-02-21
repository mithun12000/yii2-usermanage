<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model mithun\parametricfilter\models\SystemParams */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="system-params-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'param')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'table')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'label')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'ip')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'createdOn')->textInput() ?>

    <?= $form->field($model, 'updatedOn')->textInput() ?>

    <?= $form->field($model, 'createdBy')->textInput() ?>

    <?= $form->field($model, 'updatedBy')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
