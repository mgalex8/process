<?php
$this->pageTitle = Yii::app()->name . ' - Пользователи';
$this->lineTitle = 'Пользователи';
?>
<div style="padding:20px">
    <a href="/users/add/" class="btn btn-success">Добавить пользователя</a>
</div>
<table class="table">
    <tr>    
        <th width="50">ID</th>
        <th>Логин</th>
        <th width="250">Email</th>        
        <th width="240">Группа</th>                
        <th width="200"></th>
    </tr>
<?php foreach ($users as $item): ?>
    <tr id="p<?php echo $item->id; ?>">
        
        <td><?php echo $item->id; ?></td>
        <td><?php echo $item->username; ?></td>
        <td><?php echo $item->email; ?></td>
        <td><?php echo $item->group->title; ?></td>        
        <td>            
            <span>
                <a href="/process/?userid=<?php echo $item->id; ?>" class="btn btn-default">Process</a>
            </span>
            <span>
                <a href="/users/edit/<?php echo $item->id; ?>/" class="btn btn-info">Edit</a>
            </span>            
            <span>
                <a href="/users/delete/<?php echo $item->id; ?>/" class="btn btn-danger">Del</a>
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