<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

// $this->title = Yii::t('app', 'Editar Usuário ' . $model->usuario_matricula, [
//     'nameAttribute' => '' . $model->usuario_matricula,
// ]);

$this->title = 'Editar Usuário';
?>
<div class="col edit-usuario">
	<div class="row">
		<div class="col-4 offset-4">
			<div class="text-center">
				<img class="rounded" src="<?= Url::to("@web/".$model->pessoa->foto)?>" height="200px" width="200px" >
				<h3 class="nome-usuario"><?= Html::encode($model->pessoa->nome) ?></h3>
			</div>
			<?= $this->render('_update-form', [
        		'model' => $model,
        		'horariosTreino' => $horariosTreino,
        		'niveis' => $niveis,
    		]) ?>	 
		</div>
	</div>
    
</div>
