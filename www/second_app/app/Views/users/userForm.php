<?php $this->extend('base');
$this->section('styles') ?>
    <link rel="stylesheet" href="/assets/css/form.css">
<?php $this->endSection();?>




<?php $this->section('content') ?>
    <div class="form">
        <h3 class="h3 mb-4 text-center">Создать нового пользователя</h3>
        <form action="/newUser" method="post">
            <?php
            /** @var $errors \CodeIgniter\Validation\Validation */
            if(isset($validation)){
                echo "<div class='alert alert-primary mb-3'>".$validation->listErrors()."</div>";
            }
            if(isset($message)){
                echo "<div class='bg-success text-center text-white mb-3 p-2'>{$message}</div>";
            }

            ?>
            <?= csrf_field() ?>

            <div class="form-floating mb-3">
                <input type="text" class="form-control mb-2"  id="floatingInput" name="username" placeholder="введите имя" value="<?= $username??'' ?>">
                <label class="form-label" for="floatingInput">Имя</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control mb-2" id="floatingPassword" placeholder="введите пароль">
                <label class="form-label" for="floatingPassword">Пароль</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="confirm_password" class="form-control mb-2" id="floatingPassword" placeholder="введите пароль">
                <label  class="form-label" for="floatingPassword">Повтор пароля</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="email" class="form-control mb-2 " id="floatingInput" placeholder="name@example.com" value="<?= $email??'' ?>">
                <label class="form-label" for="floatingInput">Email address</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="age" class="form-control  mb-2" id="floatingInput" placeholder="возраст" value="<?= $age??'' ?>">
                <label class="form-label"  for="floatingInput">Возраст</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="id_category" class="form-control  mb-2" id="floatingInput" placeholder="Id category" value="<?= $id_category??'' ?>">
                <label class="form-label"  for="floatingInput">Категория пользователя (1-admin, 2-user)</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Сохранить</button>

        </form>
    </div>

<?php $this->endSection() ?>