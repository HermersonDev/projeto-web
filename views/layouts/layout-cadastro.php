<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;

AppAsset::register($this);
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
<body>
<?php $this->beginBody() ?>
	<div class="container">
		<?= $content ?>	
	</div>
<?php $this->endBody() ?>
<script type="text/javascript">
    $("#aluno").on( "click", function() {
        $("#aluno").addClass("btn-success");
        $("#servidor").removeClass("btn-success");
        $("#servidor").addClass("btn-default");
        $(".tipo-servidor").hide();
        $(".tipo-aluno").show();
    });

    $("#servidor").on( "click", function() {
    	$("#servidor").addClass("btn-success");
    	$("#aluno").removeClass("btn-success");
    	$("#aluno").addClass("btn-default");
        $(".tipo-aluno").hide();
        $(".tipo-servidor").show();
    });
</script>
</body>
</html>
<?php $this->endPage() ?>