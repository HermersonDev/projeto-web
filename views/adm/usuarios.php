<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;


$this->title = Yii::t('app', 'Usuários');

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
                    <th scope="col" class="text-uppercase">Perfil</th>
                    <th scope="col" class="text-uppercase">Nome</th>
                    <th scope="col" class="text-uppercase">Matrícula</th>
                    <th scope="col" class="text-uppercase">Nível</th>
                    <th scope="col" class="text-uppercase">Faltas</th>
                    <th scope="col" class="text-uppercase">Horário de Treino</th>
                    <th scope="col" class="text-uppercase">Opções</th>
                </tr>
            </thead>
            <tbody class="">
            <?php foreach($usuarios as $usuario){ ?>
                <tr>
                    <td scope="row" >
                        <img class="rounded-circle" src="<?= Url::to("@web/".$usuario->foto)?>" height="40px" width="40px" >
                    </td>
                    <td><?= Html::encode($usuario->nome) ?></td>
                    <td><?= Html::encode($usuario->matricula) ?></td>
                    <td><?= Html::encode($usuario->usuario->nivel) ?></td>
                    <td><?= Html::encode($usuario->usuario->faltas) ?></td>
                    <td>
                       <?= Html::encode($usuario->usuario->horario_treino) ?>
                    </td>
                    <td class="opcaos">
                        <a class="btn btn-primary" title="Perfil do Usuário" role="btn" href="<?= Url::toRoute(['usuario/view','id' => $usuario->matricula])?>"><i class="fas fa-eye"></i></a>
                        <!-- <a class="btn btn-outline-danger" role="btn" href="<?= Url::toRoute(['pessoa/view','id' => $usuario->matricula])?>"><i class="fas fa-user-times"></i></a> -->
                       <!--  <a class="btn btn-outline-success" role="btn" href="<?= Url::toRoute(['pessoa/view','id' => $usuario->matricula])?>"><i class="fas fa-check "></i></a> -->
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table> 
</div>
<div class="col-6 offset-3">
    <?= LinkPager::widget(['pagination'=>$pages,]) ?>
</div>

