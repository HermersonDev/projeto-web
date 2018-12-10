<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Exercicio */

$this->title = Yii::t('app', 'Novo Exercício');
?>
<div class="col exercicio-create">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'niveis' => $niveis,
    ]) ?>

</div>
