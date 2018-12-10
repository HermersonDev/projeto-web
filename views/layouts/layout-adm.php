<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AdmAsset;

AdmAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body onload="horario();">
<?php $this->beginBody() ?>
    <div id="wrapper">
        <div class="menu-lateral">
            <div class="perfil">
                <div class="text-center">
                    <img src="<?= Url::to("@web/".Yii::$app->user->identity->foto)?>" heigth="80px" width="80px" class="rounded mx-auto d-block">
                </div>
                <div class="nome text-center">
                    <h5><?= Yii::$app->user->identity->nome ?></h5>
                </div>
            </div>
            <div class="list-links">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a class="" href="<?= Url::to(['adm/usuarios', 'matricula' => Yii::$app->user->identity->matricula ]) ?>"><i class="fas fa-user-friends"></i> Usuários</a>
                    </li>
                    <li class="list-group-item">
                        <a class="" href="<?=Url::to(['adm/usuarios-ativos'])?>"><i class="fas fa-users"></i> Usuários Ativos</a>
                    </li>
                    <li class="list-group-item">
                        <a class="" href="<?=Url::to(['adm/add-usuario'])?>"><i class="fas fa-user-plus"></i> Cadastrar Usuário</a>
                    </li>
                    <li class="list-group-item">
                        <a class="" href="<?= Url::to(['adm/equipamentos']) ?>"><i class="fas fa-dumbbell"></i> Equipamentos</a>
                    </li>
                    <li class="list-group-item">
                        <a class="" href="<?= Url::to(['adm/exercicios']) ?>"><i class="fas fa-running"></i> Exercícios</a>
                    </li>
                    <li class="list-group-item">
                        <?= Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            '<i class="fas fa-sign-out-alt"></i> Sair',
                            ['class' => 'btn btn-link']
                        )
                        . Html::endForm() ?>
                                        
                    </li>
                </ul>
            </div>
        </div>
        <div class="conteudo">
            <div class="container">
                <div class="row">
                    <div class="cb-adm col-12">
                        <div class="row">
                            <div class="col">
                                <?= Html::beginForm(['/adm/iniciar-treino'], 'post',['class' => 'form-inline']) ?>
                                    <div class="form-group">
                                        <?= Html::textInput('matricula',null,['class' => 'form-control','id' => 'matricula','placeholder' => 'Matrícula']) ?>
                                    </div>
                                    <?= Html::submitButton('Iniciar Treino !',['class' => 'btn-treino btn btn-success'])?>
                                <?= Html::endForm() ?>
                            </div>
                            <div class="col text-right">
                                <h3 id="horario" class=""></h3>
                            </div>
                            <div class="nav-links col-12">
                                <?= Html::a('Novo Exercício',['exercicio/create'],['class'=>'btn btn-sm btn-secondary']) ?>
                                <?= Html::a('Novo Equipamento',['equipamento/create'],['class'=>'btn btn-sm btn-secondary']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="row-conteudo row">
                        <?= $content ?>
                    </div>
                </div>
                <footer class="rodape text-right">
                    <p>&copy; by Hermerson Araújo</p>
                </footer>    
            </div>
        </div>
    </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
