<?php
$this->pageTitle = Yii::app()->name . ' - Настройки профиля';
$this->lineTitle = 'Личный кабинет';
?>

<h1>Настройки профиля</h1>

<div class="form">

<?php $form = $this->beginWidget('CActiveForm'); ?>

	<p class="note">Поля отмеченные <span class="required">*</span> обязательны для заполнения.</p>
        <br>

        <?php if (!$errors = $form->errorSummary($model)): ?>
                <div class="bg-danger">
                        <?php echo $errors; ?>                
                </div>
                <br>
        <?php endif; ?>
        
	<div class="form-group">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('value'=>$model->email)); ?>
                <?php echo $form->error($model,'email'); ?>
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
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('value'=>$model->username)); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('value'=>$model->city)); ?>
	</div>        

	<fieldset>
		<?php echo CHtml::submitButton('Сохранить данные', array('class'=>'submit')); ?>
	</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->
