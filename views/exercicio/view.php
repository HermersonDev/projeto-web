<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Exercicio */

$this->title = $model->nome;

?>
<div class="col exercicio-view">
    <div class="row">
        <div class="col visao-bt text-right">
            <p>
                <?= Html::a(Yii::t('app', '<i class="fas fa-screwdriver"></i>'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', '<i class="fas fa-times "></i>'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>       
        </div>
    </div>
    <div class="row">
        <div class="col-3 offset-1 text-center">
            <img class="rounded" src="<?= Url::to("@web/img/exercicio.jpeg")?>" height="200px" width="200px">
        </div>
        <div class="col">
            <h3 class="title"><?= Html::encode($this->title) ?></h3>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'label' => 'Descrição',
                        'value' => $model->descricao,
                    ],
                    [
                        'label' => 'Nivel',
                        'value' => $model->nivel,
                    ],
                    [
                        'label' => 'Equipamento',
                        'value' => $model->equipamento->nome,
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>
