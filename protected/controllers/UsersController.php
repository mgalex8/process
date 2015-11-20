<?php

class UsersController extends Controller
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
                        array('allow', // allow authenticated users to access all actions
                                'roles'=>array('admin'),
                        ),
                        array('deny',  // deny all users
                                'users'=>array('*'),
                        ),
                );
        }
                      
	public function actionIndex() 
        {   
            $criteria = new CDbCriteria;            
            $criteria->select = 'id, username, email, group_id';                        
            $criteria->order = 'active DESC, created_at DESC';
            
            $count = User::model()->count($criteria);            
            $pages = new CPagination($count);            
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);            
            $users = User::model()->findAll($criteria);
           
            $this->render('list', array(
                    'users' => $users,
                    'pages' => $pages,
            ));
        }
        
        public function actionAdd() 
        {   
            $model = new NewUserForm;
            if(isset($_POST['NewUserForm']))
            {
                $model->attributes = $_POST['NewUserForm'];            
                if ($model->validate() )
                {                    
                    if ($model->saveUser())
                    {                           
                        $this->redirect('/users/');
                    }
                }
            }             
            
            $this->render('add', array(
                    'model'=>$model,
            ));
        }
        
        public function actionEdit($id) 
        {   
            $model = new NewUserForm;
            $model->loadAttributes($id);
            if(isset($_POST['NewUserForm']))
            {
                $model->attributes = $_POST['NewUserForm'];            
                if ($model->validate() )
                {                    
                    if ($model->saveUser($id))
                    {                           
                        $this->redirect('/users/');
                    }
                }
            }     
            
            $this->render('edit', array(
                    'model'=>$model,
            ));
        }
        
        public function actionDelete($id) 
        {   
            User::model()->deleteByPk($id);
            $this->redirect('/users/');
        }
        
}
