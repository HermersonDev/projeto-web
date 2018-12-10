<?php 

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $modelPessoa  app\models\Pessoa */
/* @var $modelUsuario app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="form-usuario row">
	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
		<div class='col col-lg-6'>

			<?= $form->field($modelPessoa, 'imageFile')->fileInput(['placeholder'=>'']) ?>

			<?= $form->field($modelPessoa, 'matricula')->textInput(['placeholder'=>'Matrícula','maxlength' => true])->label('') ?>

			<?= $form->field($modelPessoa, 'nome')->textInput(['placeholder'=>'Nome','maxlength' => true])->label('') ?>

			<?= $form->field($modelPessoa, 'senha')->passwordInput(['placeholder'=>'Senha','maxlength' => true])->label('') ?>

			<?= $form->field($modelPessoa, 'confirmar_senha')->passwordInput(['placeholder'=>'Confirmar Senha','maxlength' => true])->label('') ?>

			<?= $form->field($modelPessoa, 'idade')->textinput(['placeholder'=>'Idade'])->label('') ?>

			

		</div>	
		<div class="col col-lg-6">

			<?= $form->field($modelPessoa, 'email')->input('email',['placeholder'=>'E-mail','maxlength' => true])->label('') ?>

			<?= $form->field($modelPessoa, 'telefone')->textInput(['placeholder'=>'Telefone','maxlength' => true])->label('') ?>
			
			<?= $form->field($modelUsuario, 'nivel')->dropdownList($niveis)->label('') ?>

			<?= $form->field($modelUsuario, 'horario_treino')->dropdownList($horariosTreino)->label('') ?>

			<!-- Quando o usuário escolher um checkbox a opção do formulário ser vista.
				Essa visão chamara a visão correspondente ao tipo do usuário _form-aluno ou
				_form-servidor.
			-->
			
			<div id="btn-tipo">
				<a type="button" href="#" class="badge badge-pill badge-success" id="aluno">Aluno</a>
				<a type="button" href="#" class="badge badge-pill badge-secondary" id="servidor">Servidor</a>
			</div>


			<!-- MODIFICAR DAQUI PRA BAIXO -->

			<div class="tipo-aluno" style="">
				
				<?= $form->field($modelAluno, 'curso')->textInput(['placeholder'=>'Curso','maxlenght' => true])->label('') ?>
				
				<?= $form->field($modelAluno, 'periodo')->dropdownList($periodos)->label('') ?>

			</div>

			<div class="tipo-servidor" style="display:none;">
				<?= $form->field($modelServidor,'tipo')->textInput(['placeholder'=>'Função','maxlenght'=>true, 'value'=>''])->label('') ?>
			</div>

			<div class="form-group text-right ">
				<?= Html::submitButton('Concluir',['class' => 'btn btn-success']) ?>
			</div>
		</div>
	<?php ActiveForm::end(); ?>
</div>