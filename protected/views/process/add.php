<?php
$this->pageTitle = Yii::app()->name . ' - Добавить процесс';
$this->lineTitle = 'Процессы';
?>

<h1>Добавить процесс</h1>

<div class="form">
    
<?php $form=$this->beginWidget('CActiveForm'); ?>

	<p class="note">Поля отмеченные <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo CHtml::errorSummary($model); ?>

	<div class="row" style="padding:10px">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>80,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
        
        <div class="row" style="padding:10px">
                <div>Укажите время работы в секундах</div>
		<?php echo $form->labelEx($model,'limit_time'); ?>
		<?php echo $form->textField($model,'limit_time',array('size'=>80,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'limit_time'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Создать'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->