<?php

class ProfileController extends Controller
{	
        public function filters()
        {
            return array(
                'accessControl',
            );
        }
        
        public function accessRules()
        {
                return array(
                        array('allow',  // allow all users to access 'index' and 'view' actions.
                                'actions'=>array('index', 'login', 'registration'),
                                'users'=>array('*'),
                        ),
                        array('allow', // allow authenticated users to access all actions
                                'users'=>array('@'),
                        ),
                        array('deny',  // deny all users
                                'users'=>array('*'),
                        ),
                );
        }
        
        public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),	
		);
	}
        
	public function actionIndex()
	{   
                $this->render('index');
	}
        
        public function actionRegistration()
	{   
                $model = new RegistrationForm;
                if(isset($_POST['RegistrationForm']))
                {
                    $model->attributes = $_POST['RegistrationForm'];            
                    if ($model->validate() )
                    {                    
                        if ($model->registration())
                        {                           
                            $this->redirect('/profile/');
                        }
                    }
                }            
                $this->render('registration', array(
                    'model' => $model,
                ));
	}
        
        public function actionLogin()
	{   
                if (Yii::app()->user->isGuest)
                {
                    if (!defined('CRYPT_BLOWFISH')||!CRYPT_BLOWFISH)
                            throw new CHttpException(500, "This application requires that PHP was compiled with Blowfish support for crypt().");

                    $model = new LoginForm;

                    // if it is ajax validation request
                    if (isset($_POST['ajax']) && $_POST['ajax']==='login-form')
                    {
                            echo CActiveForm::validate($model);
                            Yii::app()->end();
                    }

                    // collect user input data
                    if(isset($_POST['LoginForm']))
                    {
                            $model->attributes = $_POST['LoginForm'];
                            // validate user input and redirect to the previous page if valid
                            if($model->validate() && $model->login())
                                    $this->redirect('/profile/');
                    }
                    // display the login form
                    $this->render('login', array('model'=>$model));
                }
                else
                {
                    $this->redirect('/profile/');
                }
	}
        
        public function actionLogout()
	{            
                Yii::app()->user->logout();
                $this->redirect(Yii::app()->homeUrl);
	}
        
        public function actionSettings()
	{   
                $model = new SettingsForm;
                $model->getFromDatabase();

                $formIsSaved = false;

                if(isset($_POST['SettingsForm']))
                {
                    $model->attributes = $_POST['SettingsForm'];
                    if ($model->validate() )
                    {                    
                        if ($model->saveInDatabase())
                        {                           
                            $formIsSaved = true;
                        }
                    }
                }
                $this->render('settings', array(
                    'model'=>$model,
                    'formIsSaved'=>$formIsSaved,
                ));
	}      
        
}
