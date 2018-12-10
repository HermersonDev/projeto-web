<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;


$this->title = Yii::t('app', 'Equipamentos');
?>

<div class="conteudo-header col-12">
    <div class="title row">
        <div class="col">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
</div>
<div class="col-12">
	<div class="row">
		<?php foreach ($equipamentos as $equipamento) {
		?>
		<div class="col-3 card-equips">
			<div class="card" style="width: 13rem;">
			  	<img class="card-img-top" src="<?= Url::to("@web/".$equipamento->img)?>" height="100px" width="180px" alt="Card image cap">
			  	<div class="card-body">
			    	<h5 class="card-title"><?= Html::encode($equipamento->nome) ?></h5>
			    	<p class="card-text"><?= Html::encode($equipamento->descricao) ?></p>
			   		<a href="<?= Url::to(['equipamento/view', 'id' => $equipamento->id]) ?>" class="btn btn-dark btn-sm btn-block">Visualizar</a>
			  	</div>
			</div>
		</div>
		<?php
		} ?>
		
	</div>
</div>