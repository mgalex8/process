<?php

class IndexController extends Controller
{	    
        public $layout = 'layout_index';
                
	public function actionIndex()
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
                    $this->render('index', array('model'=>$model));
                }
                else
                {
                    $this->redirect('/profile/');
                }
	}      
        
}
