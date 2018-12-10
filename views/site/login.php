<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Login';
?>


<div class="login row">
    <div class="titulo-login col-12 text-center">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="conteudo-login col-8 offset-2">
        <?php $form = ActiveForm::begin([]); ?>

            <?= $form->field($model, 'username')->textInput([
                'autofocus' => true,
                'placeholder' => 'Matrícula'
            ])->label(''); ?>

            <?= $form->field($model, 'password')->passwordInput([
                'placeholder' => 'Senha'
            ])->label('') ?>

            <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ]) ?>

            <div class="form-group">
                <div class="col-7 offset-5 text-right">
                    <?= Html::submitButton('Entrar', ['class' => 'btn btn-block', 'name' => 'login-button']) ?>
                </div>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
    <hr>
    <div class="footer-login col-12 text-center">
        <h6><b>Deseja ter uma vida ativa?</b> Primeiro você deve procurar o instrutor do turno que você deseja começa !</h6>
    </div>

</div>



