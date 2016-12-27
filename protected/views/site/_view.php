<div class="view">

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
</div>