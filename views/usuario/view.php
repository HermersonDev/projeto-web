<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = 'Usuário - '.$model->pessoa->nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col usuario-view">

    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col-6 offset-1">
                    <div class="visao-perfil row">
                        <div class="col-3 text-center">
                            <img class="rounded" src="<?= Url::to("@web/".$model->pessoa->foto)?>" height="150px" width="150px" >        
                        </div>
                        <div class="visao-text col-8 offset-1">
                            <h1><?= Html::encode($model->pessoa->nome) ?></h1>
                            <h4><?= Html::encode($model->usuario_matricula)?></h4>
                        </div>
                    </div>
                </div>
                <div class="visao-bt col-4 text-right">
                    <?= Html::a(Yii::t('app', '<i class="fas fa-user-edit"></i>'), ['update', 'id' => $model->usuario_matricula], ['class' => 'btn btn-primary', 'title' => 'Editar Usuário']) ?>
                    <?= Html::a(Yii::t('app', '<i class="fas fa-user-times"></i>'), ['delete', 'id' => $model->usuario_matricula], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],
                        'title'=>'Remover Usuário'
                    ]) ?>
                </div>
                <div class="detalhe col-10 offset-1">
                    <h2>Detalhes</h2>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'label' => 'Idade',
                                'value' => $model->pessoa->idade,
                            ],
                            [
                                'label' => 'Email',
                                'value' => $model->pessoa->email,
                            ],
                            [
                                'label' => 'Telefone',
                                'value' => $model->pessoa->telefone,
                            ], 
                            'nivel',
                            'faltas',
                            'horario_treino',
                        ],
                    ]) ?>
                </div>

            </div>
        </div>
    </div>
    

</div>
