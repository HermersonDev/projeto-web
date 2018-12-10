<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row usuario-form">

	<div class="col">
	    <?php $form = ActiveForm::begin(); ?>

	    <?= $form->field($model, 'nivel')->dropdownList($niveis) ?>

	    <?= $form->field($model, 'faltas')->textInput() ?>

	    <?= $form->field($model, 'horario_treino')->dropdownList($horariosTreino) ?>

	    <div class="form-group">
	        <?= Html::submitButton(Yii::t('app', 'Salvar'), ['class' => 'btn btn-success']) ?>
	    </div>

	    <?php ActiveForm::end(); ?>
	</div>

</div>