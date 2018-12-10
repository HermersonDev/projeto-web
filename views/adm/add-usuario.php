<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="add-cb col-6 offset-3">
	<h3 class="text-center">Permissão de Cadastro</h3>
	<p>
		O instrutor deverá preencher os seguintes campos para que o usuário possa se cadastrar no sistema.
	</p>
</div>
<div class="add-form col-6 offset-3 ">
	<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($modelToken, 'email')->textInput(['placeholder'=>'E-mail'])->label('') ?>

    <?= $form->field($modelToken, 'matricula_usuario')->textInput(['placeholder'=>'Matrícula'])->label('') ?>
    

    <div class="form-group text-right">
        <?= Html::submitButton(Yii::t('app', 'Concluir'), ['class' => 'btn btn-success']) ?>
    </div>

    <?= $form->field($modelToken, 'token_acesso')->hiddenInput(['value'=>'token'])->label('') ?>
    
    <?= $form->field($modelToken, 'matricula_instrutor')->hiddenInput(['value' => Yii::$app->user->identity->matricula ])->label('') ?>

    <?php ActiveForm::end(); ?>
</div>