<?php

class ProcessController extends Controller
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
        
        public function actionIndex() 
        {    
            /*
            $order = 'active DESC, created_at DESC';            
            if (!empty($_GET['orderby']) && !empty($_GET['sort'])) {
                $sortGet = $_GET['sort'];
                $orderby = $_GET['orderby'];
                $fieldsArray = array('active', 'created_at', 'name', 'run_dt');
                $sort = (strtoupper($sortGet) == 'DESC') ? 'DESC' : 'ASC';
                if (in_array($orderby, $fieldsArray)) {
                    $order = $order.' '.$sort;
                }
            }             
            */               
            $userid = $_GET['userid'];
            if (!empty($userid)) {           
                $user = User::model()->findByPk($userid);                
                if ($user === null) {                    
                    throw new CHttpException(404, 'Пользователь не найден');
                }
            }         
            
            $criteria = new CDbCriteria;            
            $criteria->select = 'id, name, creaby, run_dt, limit_time, status, counter, created_at';                        
            $criteria->order = 'active DESC, created_at DESC';
            if (!empty($userid) && $user !== null) {
                $criteria->condition = 'creaby=:User';
                $criteria->params = array(':User'=>$userid);
            }
            
            $count = Process::model()->count($criteria);            
            $pages = new CPagination($count);            
            $pages->pageSize = 5;
            $pages->applyLimit($criteria);            
            $processes = Process::model()->findAll($criteria);
           
            $this->render('list', array(
                    'processes' => $processes,
                    'pages' => $pages,
            ));
        }
        
        public function actionAdd() 
        {   
            $model = new Process;
            if(isset($_POST['Process'])) {
                $model->attributes=$_POST['Process'];
                $model->creaby = Yii::app()->user->getId();
                if($model->save()) {
                        $this->redirect('/process/');
                }            
            }
            
            $this->render('add', array(
                    'model'=>$model,
            ));
        }
        
        public function actionEdit($id) 
        {   
            $model = Process::model()->findByPk($id);
            if(isset($_POST['Process'])) {
                $model->attributes=$_POST['Process'];
                $model->creaby = Yii::app()->user->getId();
                if($model->save()) {
                        $this->redirect('/process/');
                }            
            }
            
            $this->render('edit', array(
                    'model'=>$model,
            ));
        }
        
        public function actionDelete($id) 
        {   
            Process::model()->deleteByPk($id);
            $this->redirect('/process/');
        }
                
        public function actionRun() 
        {
            $json = array('success'=>0);
            if (!empty($_POST['id']) && is_numeric($_POST['id'])) 
            {
                $process = Process::model()->findByPk($_POST['id']);
                if ($process !== null) {
                    $process->Run();
                    $json = array(
                        'success' => 1,
                        'id' => $_POST['id'],
                        'runDt' => $process->runDt,
                    );
                }
            }
            echo json_encode($json);            
        }
                
        public function actionStop()
        {
            $json = array('success'=>0);
            if (!empty($_POST['id']) && is_numeric($_POST['id'])) 
            {
                $process = Process::model()->findByPk($_POST['id']);
                if ($process !== null) {
                    $process->Stop();                    
                    $json = array(
                        'success' => 1,
                        'id' => $_POST['id'],
                        'counterTime' => $process->secondsToTime($process->counter),                        
                        'runDt' => $process->runDt,
                        'status' => $process->status,
                    );
                }
            }
            echo json_encode($json);
        }
                
        public function actionReset() 
        {
            $json = array('success'=>0);
            if (!empty($_POST['id']) && is_numeric($_POST['id'])) 
            {
                $process = Process::model()->findByPk($_POST['id']);
                if ($process !== null) {
                    $process->Reset();
                    $json = array(
                        'success' => 1,
                        'id' => $_POST['id'],                        
                    );
                }
            }
            echo json_encode($json);            
        }
}
