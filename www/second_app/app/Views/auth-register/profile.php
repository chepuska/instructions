<?php $this->extend('base');
    $this->section('content');
    if (isset($user)):
?>
<!--    здесь данные из сессии-->
    <h3 class="text-center mb-4">Личный кабинет <? echo $user->get('username') ?></h3>
    <?php
        if(isset($message)){
        echo "<div class='alert alert-primary'>{$message}</div>";
    }
    ?>
    <h4 class="mb-3">Личные данные:</h4>
        <p>Email:  <span style="font-weight: bold"><? echo $user->get('email');?></span></p>
<form action="/profile/<? echo $user->get('id')?>" method="post">
    <div class="form-floating mb-3" id="form">
         <input class="form-control mb-2"  type="password" name="password" id="password" placeholder="Password">
         <label class="form-label" for="password">Password</label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit" >Изменить пароль</button>
</form>

<?php
        endif;
        $this->endSection();?>