<?php
$this->pageTitle = Yii::app()->name . ' - Процессы';
$this->lineTitle = 'Процессы';
?>
<div style="padding:20px">
    <a href="/process/add/" class="btn btn-success">Добавить процесс</a>
</div>
<table class="table">
    <tr>    
        <th width="50">ID</th>
        <th>Наименование</th>
        <th width="100">Лимит</th>        
        <th width="140">Время работы</th>
        <th width="120">Статус</th>
        <th width="120">Дата запуска</th>
        <th width="300"></th>
    </tr>
<?php foreach ($processes as $item): ?>
    <tr id="p<?php echo $item->id; ?>">
        
        <td><?php echo $item->id; ?></td>
        <td><?php echo $item->name; ?></td>
        <td class="limit-time"><?php echo $item->limitTime; ?></td>
        <td class="counter-time"><?php echo $item->counterTime; ?></td>
        <td class="status-text"><?php echo $item->statusText; ?></td>
        <td class="run-dt"><?php echo $item->runDt ?></td>
        <td>            
            <span>
                <input class="btn btn-default reset-process" type="button"  data-id="<?php echo $item->id; ?>" value="Reset">
            </span>
            <span>
                <a href="/process/edit/<?php echo $item->id; ?>/" class="btn btn-info">Edit</a>
            </span>
            <span>
                <a href="/process/delete/<?php echo $item->id; ?>/" class="btn btn-danger">Del</a>
            </span>
            <span class="stop-run-btns">
            <?php if ($item->status == 'stop' || $item->status == 'create') { ?>
                <input class="btn btn-success run-process" type="button" data-id="<?php echo $item->id; ?>" value="Run">
            <?php } elseif($item->status == 'run') {?>
                <input class="btn btn-danger stop-process" type="button" data-id="<?php echo $item->id; ?>" value="Stop">
            <?php } ?>   
            </span>
        </td>
    </tr>
<?php endforeach; ?>
</table>

<div class="pagination pagination__posts">
<?php 
    $this->widget('SiteLinkPager', array(
        'pages' => $pages,        
        'htmlOptions' => array('class' => 'pagination'),
        'selectedPageCssClass' => 'active',        
    ));
?>
</div>
<script>
$(function(){
    $(".stop-run-btns").delegate(".run-process", "click", function(){
        var id = $(this).data('id');          
        $.ajax({
            url: "/process/run/", 
            data: {id:id}, 
            dataType: 'json',
            method: 'post',
            success: function(data){
                console.log(data);
                if (data.success == 1) {
                    $('#p'+data.id).find('.stop-run-btns').html('<input class="btn btn-danger stop-process" type="button" data-id="'+data.id+'" value="Stop">');
                    $('#p'+data.id).find('.status-text').text('Запущен');
                    $('#p'+data.id).find('.run-dt').text(data.runDt);
                }                
            },
            error: function(xhr, error, errorThrown) {
                console.log(error);
                console.log(errorThrown);
            }
        });
    });
   
    $(".stop-run-btns").delegate(".stop-process", "click", function(){
        var id = $(this).data('id');                      
        $.ajax({
            url: "/process/stop/", 
            data: {id:id}, 
            dataType: 'json',
            method: 'post',
            success: function(data){
                console.log(data);
                if (data.success == 1) {
                    if (data.status == 'end') {
                        $('#p'+data.id).find('.stop-run-btns').html('');
                        $('#p'+data.id).find('.status-text').text('Завершен');
                    }
                    else {
                        $('#p'+data.id).find('.stop-run-btns').html('<input class="btn btn-success run-process" type="button" data-id="'+data.id+'" value="Run">');
                        $('#p'+data.id).find('.status-text').text('Остановлен');                        
                    }
                    $('#p'+data.id).find('.counter-time').text(data.counterTime);
                    $('#p'+data.id).find('.run-dt').text(data.runDt);
                }              
            },
            error: function(xhr, error, errorThrown) {
                console.log(error);
                console.log(errorThrown);
            }
        });        
    });
    
    $(".reset-process").click(function(){
        var id = $(this).data('id');                      
        $.ajax({
            url: "/process/reset/", 
            data: {id:id}, 
            dataType: 'json',
            method: 'post',
            success: function(data){
                console.log(data);
                if (data.success == 1) {
                    $('.stop-run-btns').html('<input class="btn btn-success run-process" type="button" data-id="'+data.id+'" value="Run">');
                    $('#p'+data.id).find('.status-text').text('Создан');
                    $('#p'+data.id).find('.counter-time').text('00:00:00');
                    $('#p'+data.id).find('.run-dt').text('-');
                }              
            },
            error: function(xhr, error, errorThrown) {
                console.log(error);
                console.log(errorThrown);
            }
        });        
    });
});
</script>


