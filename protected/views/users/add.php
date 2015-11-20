<?php
$this->pageTitle = Yii::app()->name . ' - Новый пользователь';
$this->lineTitle = 'Пользователи';
?>

<h1>Новый пользователь</h1>

<div class="form">

<?php $form = $this->beginWidget('CActiveForm'); ?>
	
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
    
        <div class="form-group">
            <label for="NewUserForm_group" class="required">Группа <span class="required">*</span></label>
            <select name="NewUserForm[group]" id="NewUserForm_group">	
                <option value="admin">Администратор</option>
                <option value="manager">Процесс-менеджер</option>
            </select>
        </div>
	
        
	<fieldset>
		<?php echo CHtml::submitButton('Сохранить данные', array('class'=>'submit')); ?>
	</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->
