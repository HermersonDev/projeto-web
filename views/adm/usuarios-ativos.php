<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;


$this->title = Yii::t('app', 'Usuários Ativos');

?>

<div class="conteudo-header col-12">
    <div class="title row">
        <div class="col">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
</div>
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="col-12">
    <table class="table table-hover text-center">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-uppercase">Matricula</th>
                <th scope="col" class="text-uppercase">Nível</th>
                <th scope="col" class="text-uppercase">Início do Treino</th>
                <th scope="col" class="text-uppercase">Opções</th>
            </tr>
        </thead>
        <tbody class="">
        <?php foreach($ativos as $usuario){ ?>
            <tr>
                <td><?= Html::encode($usuario->mat_usuario) ?></td>
                <td><?= Html::encode($usuario->matUsuario->nivel) ?></td>
                <td><?= Html::encode($usuario->hora_inicio) ?></td>
                <td class="opcaos">
                    <a class="btn btn-danger" title="Terminar Treino" role="btn" href="<?= Url::to(['adm/termina-treino','id' => $usuario->id,'matricula' => $usuario->mat_usuario])?>"><i class="fas fa-user-check"></i></a>
                  
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table> 
</div>
<div class="col-6 offset-3">
    <?= LinkPager::widget(['pagination'=>$pagesAtivos,]) ?>
</div>
<div class="col-12">
    <div class=" treino-concluido row">
        <div class="col-12">
            <h2>Treinos Concluídos</h2>
        </div>
        <div class="col-12">
            <table class="table table-hover table-sm table-dark text-center">
                <thead class="">
                    <tr>
                        <th scope="col" class="text-uppercase">Matricula</th>
                        <th scope="col" class="text-uppercase">Nível</th>
                        <th scope="col" class="text-uppercase">Início do Treino</th>
                        <th scope="col" class="text-uppercase">Final do Treino</th>
                    </tr>
                </thead>
                <tbody class="">
                <?php foreach($concluidos as $usuario){ ?>
                    <tr>
                        <td><?= Html::a(Html::encode($usuario->mat_usuario),
                            Url::to(['usuario/view', 'id' => $usuario->mat_usuario]),
                            [ 'class' => 'btn btn-info'])  ?></td>
                        <td><?= Html::encode($usuario->matUsuario->nivel) ?></td>
                        <td><?= Html::encode($usuario->hora_inicio) ?></td>
                        <td><?= Html::encode($usuario->hora_final) ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table> 
        </div>
    </div>
</div>
<div class="col-6 offset-3">
    <?= LinkPager::widget(['pagination'=>$pagesConcluidos,]) ?>
</div>

