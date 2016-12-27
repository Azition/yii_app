<div class="view">

	<? if (isset(Yii::app()->user->role) && Yii::app()->user->role === 'admin'): ?>
		<b>Пользователь</b>
		<?= User::model()->find('id = :id',[':id' => $data->id_user])->username?>
		<br />
	<? endif;?>
	<b>Заголовок:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b>Сообщение:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b>Статус:</b>
	<? if ($data->status == 'wait'):?>
		<span style="color: red">В ожидании</span>
	<? else:?>
		<span style="color: green">Сообщение обработано</span>
	<? endif;?>
	<br />
	<? if ($data->answer):?>
		<b>Ответ:</b>
		<?php echo CHtml::encode($data->answer); ?>
		<br />
	<? endif;?>
	<? if (isset(Yii::app()->user->role) && Yii::app()->user->role === 'admin' && !$data->answer): ?>
		<?= CHTML::link('Ответить',['site/setanswer','id' => $data->id])?>
	<? endif;?>
</div>