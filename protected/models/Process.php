<?php

class Process extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'tbl_post':
	 * @var integer $id	 
	 * @var string  $name
         * @var string  $creaby
         * @var string  $status
         * @var string  $run_dt
         * @var integer $created_at
         * @var integer $updated_at	 
	 * @var date    $created
	 */
    
         public $limitTime;
         public $counterTime;
         public $statusText;
         public $runDt;

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{processes}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, creaby, limit_time', 'required'),			
			array('name', 'length', 'max'=>255),
                        array('status', 'in', 'range'=>array('create','run','stop','end')),
                        array('created_at', 'length', 'max'=>10),
                        array('updated_at', 'length', 'max'=>10),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                        'user' => array(self::BELONGS_TO, 'User', 'creaby'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Наименование',
			'creaby' => 'Менеджер',
			'active' => 'Запуск',
                        'limit_time' => 'Время работы',
			'run_dt' => 'Дата запуска',
                        'created_at' => 'Дата создания',
		);
	}

	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	
        protected function beforeSave()
	{
		if(parent::beforeSave()) {
			if($this->isNewRecord) {
				$this->created_at = $this->updated_at = time();				
			}
			else {
				$this->updated_at = time();
                        }                        
                        // End
                        if ($this->counter > $this->limit_time) {
                            $this->status = 'end';
                        }                        
                        $this->changeAttributes();
                        
			return true;
		}
		else
			return false;
	}
        
        protected function afterFind()
	{
		parent::afterFind();
                
                $this->changeAttributes();
                
                // Run
                if ($this->status == 'run') {
                    $this->counter = $this->counter + time() - $this->run_dt;
                }
                // End
                if ($this->counter > $this->limit_time) {
                    $this->status = 'end';
                }
                $this->save();	
	}
        

	
	/**
	 * This is invoked after the record is deleted.
	 */
	protected function afterDelete()
	{
		parent::afterDelete();		
	}
        
        
        public function getLast($count)
	{
                $criteria = new CDbCriteria;                
                $criteria->order = 'sort ASC, created_at DESC, id ASC';
                $criteria->limit = $count;          
                return $this->findAll($criteria);
        }
        
        public function Run() {
            $this->status = 'run';
            $this->run_dt = time();
            $this->save();
        }
        
        public function Stop() {
            $this->status = 'stop';
            //$this->counter = $this->counter + time() - $this->run_dt;
            $this->save();
            return $this->counter;
        }
        
        public function Reset() {
            $this->status = 'create';
            $this->counter = 0;
            $this->save();
        }
        
        public function secondsToTime($counter) {
            $hours = floor($counter/3600);            
            $minutes = floor(($counter/3600 - $hours)*60);
            $seconds = $counter - $hours*3600 - $minutes*60;                  
            $hours = $hours < 10 ? '0'.$hours : $hours;                
            $minutes = $minutes < 10 ? '0'.$minutes : $minutes;                
            $seconds = $seconds < 10 ? '0'.$seconds : $seconds;
            
            return $hours.':'.$minutes.':'.$seconds;
        }
        
        protected function changeAttributes() {
            //statusText
            if ($this->status == 'run') {
                $this->statusText = 'Запущен';
            }                
            elseif ($this->status == 'stop') {
                $this->statusText = 'Остановлен';
            }
            elseif ($this->status == 'end') {
                $this->statusText = 'Завершен';
            }
            else {
                //create: 
                $this->statusText = 'Создан';                
            }

            // runDt
            if (!empty($this->run_dt)) {
                $this->runDt = date('d/m/Y H:i:s', $this->run_dt);
            }
            else {
                $this->runDt = '-';
            }                
            //counters                
            $this->limitTime = $this->secondsToTime($this->limit_time);                
            $this->counterTime = $this->secondsToTime($this->counter);             
        }
}