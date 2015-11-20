<?php if (Yii::app()->user->isGuest): ?>
<div class="col-md-4 blog_sidebar">        
            <ul class="sidebar">
                <h3>Личный кабинет</h3>
                <li><i class="fa fa-plus-square"></i> &nbsp; <a href="/profile/registration/">Регистрация</a></li>      
                <li><i class="fa fa-sign-in"></i> &nbsp; <a href="/">Вход</a></li>
            </ul>  
</div>
<?php endif; ?> 


