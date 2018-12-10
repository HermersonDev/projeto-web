<?php

use yii\helpers\Html;

$this->title = "Cadastro";

?>
<div class="row">
	
	<h1 class="text-center"><?= Html::encode($this->title) ?></h1>
	
	<?= $this->render('_form-usuario', [
        'modelPessoa' => $modelPessoa,
        'modelUsuario' => $modelUsuario,
        'modelAluno' => $modelAluno,
        'modelServidor' => $modelServidor,
        'horariosTreino' => $horariosTreino,
        'niveis' => $niveis,
        'periodos' => $periodos,
    ]) ?>

</div>