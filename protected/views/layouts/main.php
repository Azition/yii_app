<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">
	
	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<?
		$menuItems = [
			'admin' => [
				[
					'label' => 'Список обращении',
					'path' => ['/site/index'],
					'isShow' => true
				],
				[
					'label' => '',
					'path' => [''],
					'isShow' => false
				]
			],
			'user' => [
				[
					'label' => 'Обращения',
					'path' => ['/site/index'],
					'isShow' => true
				],
				[
					'label' => 'Обратиться',
					'path' => ['/site/createmsg'],
					'isShow' => true
				]
			]
		];
		if (isset(Yii::app()->user->role))
			$role = Yii::app()->user->role;
		else $role = 'user';
	?>

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array(
					'label'=>$menuItems[$role][0]['label'], 
					'url'=>$menuItems[$role][0]['path'], 
					'visible'=>!Yii::app()->user->isGuest && $menuItems[$role][0]['isShow']),
				array(
					'label'=>$menuItems[$role][1]['label'], 
					'url'=>$menuItems[$role][1]['path'], 
					'visible'=>!Yii::app()->user->isGuest && $menuItems[$role][1]['isShow']),
				array(
					'label'=>'Авторизация', 
					'url'=>array('/site/index'), 
					'visible'=>Yii::app()->user->isGuest),
				array(
					'label'=>'Регистрация', 
					'url'=>array('/site/regist'), 
					'visible'=>Yii::app()->user->isGuest),
				array(
					'label'=>'Выйти ('.Yii::app()->user->name.')', 
					'url'=>array('/site/logout'), 
					'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
