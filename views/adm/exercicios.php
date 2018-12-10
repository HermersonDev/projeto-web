<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;


$this->title = Yii::t('app', 'Exercicios');
?>

<div class="conteudo-header col-12">
    <div class="title row">
        <div class="col">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
</div>
<div class="col-12">
	<table class="table table-hover text-center	">
		<thead class="thead-dark">
			<tr>
				<th scope="col" class="text-uppercase">Nome</th>
				<th scope="col" class="text-uppercase">Equipmaneto</th>
				<th scope="col" class="text-uppercase">Nível</th>
				<th scope="col" class="text-uppercase">Opções</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($exercicios as $exercicio) {
			?>
			<tr>
				<td scope="row"><?= Html::encode($exercicio->nome) ?></td>
				<td><?= Html::encode($exercicio->equipamento->nome) ?></td>
				<td><?= Html::encode($exercicio->nivel) ?></td>
				<td>
					<a class="btn btn-primary" title="Perfil do Usuário" role="btn" href="<?= Url::toRoute(['exercicio/view','id' => $exercicio->id])?>"><i class="fas fa-eye"></i></a>
				</td>
			</tr>
			<?php
			} ?>
		</tbody>
	</table>
	<!-- <div class="row">

		<?php foreach ($exercicios as $exercicio) {
		?>
		<div class="col-2 card-equips">
			<div class="card" style="width: 13rem;">
			  	<img class="card-img-top" src="<?= Url::to("@web/img/exercicio.jpeg")?>" height="100px" width="180px" alt="Card image cap">
			  	<div class="card-body">
			    	<h5 class="card-title"><?= Html::encode($exercicio->nome) ?></h5>
			    	<p class="card-text"><?= Html::encode($exercicio->descricao) ?></p>
			   		<a href="<?= Url::to(['exercicio/view', 'id' => $exercicio->id]) ?>" class="btn btn-dark btn-sm btn-block">Visualizar</a>
			  	</div>
			</div>
		</div>
		<?php
		} ?>
		
	</div> -->
</div>