<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Процессы',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
                'application.models.forms.*',                
		'application.components.*',
                'application.components.linkpager.*',
                'application.components.widgets.*',
                'application.components.services.*',
                'application.extensions.yii-debug-toolbar.*'
	),
    
        'modules'=>array(
            'gii'=>array(
                'class'=>'system.gii.GiiModule',
                'password'=>'sammerset',
            ),
        ),

	'defaultController'=>'index',
    
        'sourceLanguage'=>'en_US',
        'language'=>'ru_RU',

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,                        
                        'loginUrl' => array('/'),
		),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=process',
			'emulatePrepare' => true,
                        'enableParamLogging' => true,                        
                        //'enableProfiling' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => '',
		),		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
                'authManager' => array(
                        // Будем использовать свой менеджер авторизации
                        'class' => 'PhpAuthManager',                
                        'defaultRoles' => array('guest'),
                ),
                'user'=>array(
                    'class' => 'WebUser',
                    'allowAutoLogin' => true,
                ),
		'urlManager'=>array(
			'urlFormat'=>'path',
                        'showScriptName'=>false,
                        'caseSensitive'=>false,
			'rules'=>array(				                                
                                '<controller:\w+>/<action:\w+>/<id:\S+>'    =>  '<controller>/<action>',
				'<controller:\w+>/<action:\w+>'             =>  '<controller>/<action>',
                                '<controller:\w+>'                          =>  '<controller>/index',
			),
		),                 
		'log'=>array(
			'class'=>'CLogRouter',
                        'enabled'=>YII_DEBUG,
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
                                array(
                                        // направляем результаты профайлинга в ProfileLogRoute (отображается
                                        // внизу страницы)
                                        'class'=>'CProfileLogRoute',
                                        'levels'=>'profile',
                                        'enabled'=>true,
                                ),/*				
                                array(                                 
					'class'=>'CWebLogRoute',                                                                                
				),                                
                                /*array(
                                    'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                                    'ipFilters'=>array('*'),
                                ),
                                 * 
                                 */
			),
		),                  
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);