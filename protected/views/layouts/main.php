<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href="<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/bootstrap.min.css" type='text/css' />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/font-awesome.min.css">
    <link rel='stylesheet' href="<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/style.css" type='text/css' />
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/js/script.js"></script>
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
</head>
<body>
<div class="about">
  <div class="container">
    <section class="title-section">
      <h1 class="title-header"> <?php echo $this->lineTitle; ?>  </h1>
    </section>
  </div>
</div>

<div class="container">
  <div class="row">
      <div class="menu">
          <?php if ( ! Yii::app()->user->isGuest): ?>
            <ul class="nav">
                <li><a href="/users/">Пользователи</a></li>
                <li><a href="/process/">Процессы</a></li>
                <li><a href="/profile/settings/">Профиль (<?php echo Yii::app()->user->username; ?>)</a></li>
                <li><a href="/profile/logout/">Выход</a></li>                                            
             </ul>      
          <?php endif?>
      <script type="text/javascript" src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/js/responsive-nav.js"></script> 
    </div>
      
        <?php echo $content; ?>
      
  </div>
</div>