<?php
$this->pageTitle = Yii::app()->name . ' - Регистрация';
$this->lineTitle = 'Личный кабинет';
?>

<h1>Регистрация</h1>

<p>Зарегистрируйтесь на сайте, чтобы получить доступ ко всем возможностям.</p>
<br>

<div class="form">

<?php $form = $this->beginWidget('CActiveForm'); ?>

	<p class="note">Поля отмеченные <span class="required">*</span> обязательны для заполнения.</p>
        <br>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model, 'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'confirm'); ?>
		<?php echo $form->passwordField($model,'confirm'); ?>
	</div>
        <div class="form-group">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
	</div>	
	
        <?php/*
	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="form-group">
                <?php echo $form->labelEx($model,'verifyCode'); ?>
                <div>
                    <?php $this->widget('CCaptcha'); ?>
                    <?php echo $form->textField($model,'verifyCode'); ?>
                </div>
                <div class="hint">Пожалуйста, введите код, указанный на картинке.</div>
	</div>
	<?php endif; ?>         
         */?>

	<fieldset>
		<?php echo CHtml::submitButton('Сохранить данные', array('class'=>'submit')); ?>
	</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->
