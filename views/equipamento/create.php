<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Equipamento */

$this->title = Yii::t('app', 'Novo Equipamento');
?>
<div class="col equipamento-create">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
