<?php $this->beginContent('/layouts/main'); ?>
    <div class="col-md-12">
        
        <?php echo $content; ?>

    </div>
<?php $this->endContent(); ?>
<?php $this->renderPartial('/layouts/_footer', array()); ?>