<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Equipamento */

$this->title = Yii::t('app', 'Editar Equipamento - ' . $model->nome, [
    'nameAttribute' => '' . $model->nome,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Equipamentos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="col equipamento-update">
	<div class=" title text-center row">
		<div class="col">
			<h1><?= Html::encode($this->title) ?></h1>
		</div>
	</div>
    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
