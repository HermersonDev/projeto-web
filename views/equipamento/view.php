<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Equipamento */

$this->title = 'Equipamento - '.$model->nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Equipamentos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col equipamento-view">
    <div class="row">
        <div class="col-12">
            <div class="equip row">
                <div class="col text-right">
                    <p>
                        <?= Html::a(Yii::t('app', '<i class="fas fa-screwdriver"></i>'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary','title'=>'Editar Equipamento']) ?>
                        <?= Html::a(Yii::t('app', '<i class="fas fa-times "></i>'), ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-danger',
                                'title' => 'Excluir Equipamento',
                                'data' => [
                                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                        ]) ?>
                    </p>
                </div>
            </div>
            <div class="equip-perfil row">
                <div class="col-3 offset-1">
                    <img src="<?= Url::to("@web/".$model->img) ?>" class="rounded" height="200" width="200" >
                </div>
                <div class="col">
                    <h3 class="title"><?= Html::encode($model->nome) ?></h3>
                    <p>
                        
                    </p>
                    <h4>Descrição:</h4>
                    <p>
                        <?= Html::encode($model->descricao) ?>
                    </p>
                </div>
            </div>      
        </div>
        <div class="col">
            <div class="row">
                <div class="col offset-1">
                    <h4 class="shadow-sm p-2 mb-4">Exercícios Relacionados</h4>
                    <table class="table table-dark table-sm">
                        <thead class="">
                            <tr>
                                <th scope="col" class="text-uppercase">Nome</th>
                                <th scope="col" class="text-uppercase">Nível</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($exercicios as $exercicio) {
                            ?>
                                <tr>
                                    <th scope="row"><?= Html::encode($exercicio->nome) ?></th>
                                    <td><?= Html::encode($exercicio->nivel) ?></td>
                                </tr>
                            <?php
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
