<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\BootstrapAsset;

BootstrapAsset::register($this);
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
    <style type="text/css">
        .header{
            background-color: #00CED1;
            padding: 10px; 
        }
        .pessoa-info{
            
            /*border: 1px dashed white;*/
        }
        .pessoa-links{
            /*border: 1px dashed black;*/
        }
        .nav-link{
            color: white;
        }
        .links-op{
          
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<div class="container-fluid">
    <div class="header row text-center">
        <div class="pessoa-info col-2 align-self-center">
            <img height='100' width='100' src="<?= Url::to('@web/img/h.jpg') ?>"  class="rounded">
            <h3><?= Yii::$app->user->identity->nome ?></h3>
        </div>
        <div class="pessoa-links col-8 col align-self-end">
            <div class="row">
                <div class="links-nav col">
                    <nav class="nav">
                        <a class="nav-link active" href="#">Inicio</a>
                        <a class="nav-link" href="#">Exercícios</a>
                        <a class="nav-link" href="#">Horários</a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="links-op col-1 offset-1 text-right">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="#">C</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">S</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="pessoa-conteudo row">
        <div class="col">
            <?= $content ?>  
        </div>    
    </div> 
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
