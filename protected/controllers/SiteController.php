<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		if (Yii::app()->user->isGuest)
			$this->actionLogin();
		else{
			$dataProvider=new CActiveDataProvider('Messages');
			if (isset(Yii::app()->user->role) 
				&& Yii::app()->user->role === 'user'){
				$criteria = new CDbCriteria();
				$criteria->condition = 'id_user = :id';
				$criteria->params = [':id' => Yii::app()->user->uid];
				$dataProvider->criteria = $criteria;
			}
			$this->render('msglist',[
				'dataProvider'=>$dataProvider,
			]);
		}
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	public function actionRegist(){
		$model = new User;

		if(isset($_POST['User']))
		{
			$_POST['User']['password'] = CPasswordHelper::hashPassword($_POST['User']['password']);
			$_POST['User']['role'] = 'user';
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('login'));
		}

		$this->render('regist',array(
			'model'=>$model,
		));
	}

	public function actionCreatemsg(){

		$model = new Messages;

		if(isset($_POST['Messages']))
		{

			$_POST['Messages']['status'] = 'wait';
			$_POST['Messages']['id_user'] = Yii::app()->user->uid;
			$model->attributes=$_POST['Messages'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('createmsg', [
			'model' => $model
		]);
	}

	public function actionSetanswer(){

		$model = new Messages;
		if (isset($_GET['id'])) {
			$msg_id = $_GET['id'];
		}
		$model = $model->find('id = :id', [':id' => $msg_id]);

		if(isset($_POST['Messages']))
		{

			$_POST['Messages']['status'] = 'success';
			$model->attributes=$_POST['Messages'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('setanswer', [
			'model' => $model,
		]);
	}

	public function actionDetailmsg(){

		$model = new Messages;
		if (isset($_GET['id'])) {
			$msg_id = $_GET['id'];
		}
		$model = $model->find('id = :id', [':id' => $msg_id]);

		$this->render('detailmsg', [
			'model' => $model,
		]);
	} 

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}