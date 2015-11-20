<?php
$this->pageTitle=Yii::app()->name . ' - Вход в личный кабинет';
$this->lineTitle = 'Личный кабинет';
?>

<h1>Вход в личный кабинет</h1>

<div class="form">
<?php 
    $form = $this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>true,
    )); 
?>

	<p class="note">Поля отмеченые <span class="required">*</span> обязательны для заполнения.</p>

	<div class="form-group">
		<?php echo $form->labelEx($model,'Email: '); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'Пароль: '); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>		
	</div>

	<div class="form-group">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<fieldset>
		<?php echo CHtml::submitButton('Войти', array('class'=>'submit')); ?>
	</fieldset>

<?php $this->endWidget(); ?>
</div><!-- form -->