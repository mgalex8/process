<?php $this->beginContent('/layouts/main'); ?>
    <div class="col-md-8">
        
        <?php echo $content; ?>

    </div>
<?php $this->renderPartial('/layouts/_right_side', array()); ?>
<?php $this->endContent(); ?>
<?php $this->renderPartial('/layouts/_footer', array()); ?>