<?php $this->extend('base');
 $this->section('styles') ?>
    <link rel="stylesheet" href="/assets/css/form.css">
<?php $this->endSection();?>




<?php $this->section('content') ?>
    <div class="form">
        <h1 class="h3 mb-3 fw-normal">Регистрация</h1>
    <form action="" method="post" id="register-form">
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
    <!--        <recaptcha-->
            <button class="g-recaptcha w-100 btn btn-lg btn-primary"
            data-sitekey="6LfDtK0bAAAAAKn_cSB5WwE9PQSvvzv2Xz-KGCEV"
            data-callback='onSubmit'
            data-action='submit'>Register</button>

<!--            -->

        </form>
    </div>

<?php $this->endSection();
    $this->section('scripts')
?>

    <script src="https://www.google.com/recaptcha/api.js"></script>

    <script>
        function onSubmit(token) {
            document.getElementById("register-form").submit();
        }
    </script>
<?php $this->endSection();
