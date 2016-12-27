<div class="form">

	<b>Пользователь:</b>
	<?= User::model()->find('id = :id', [':id' => $model->id_user])->username?>
	<br>
	<b>Вопрос:</b>
	<?= $model->description?>
	<br>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'answer',['label' => 'Ответ']); ?>
		<?php echo $form->textArea($model,'answer',array(
				'cols' => 60,
				'maxlength' => 254,
				'rows' => 10
			)); ?>
		<?php echo $form->error($model,'answer'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Ответить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->