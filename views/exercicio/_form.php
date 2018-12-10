<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Exercicio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row exercicio-form">

    <div class="col-6 offset-3  ">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'descricao')->textarea(['maxlength' => true]) ?>

       <!--  <?= $form->field($model, 'img')->textarea(['rows' => 6]) ?> -->

        <?= $form->field($model, 'nivel')->dropdownList($niveis) ?>

        <!--<?= $form->field($model, 'idEquipamento')->textInput() ?>-->

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Salvar'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
