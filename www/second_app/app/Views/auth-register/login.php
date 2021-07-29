<?php $this->extend('base')?>
<?php $this->section('styles') ?>
    <link rel="stylesheet" href="/assets/css/form.css">
<?php $this->endSection() ?>

<?php $this->section('content') ?>
<div class="form">
    <h1 class="h3 mb-3 fw-normal">Авторизация</h1>
    <?php if(session()->getFlashdata('message')): ?>
        <div class="alert alert-primary"><?= session()->getFlashdata('message'); ?></div>
    <?php endif;?>
    <form action="/login" method="post" id="login-form">
        <?php
        /** @var $errors \CodeIgniter\Validation\Validation */
        if(isset($errors)){
            echo "<div class='alert alert-primary'>".$errors->listErrors()."</div>";
        }
        if(isset($message)){
            echo "<div class='bg-success text-center text-white mb-3 p-2'>{$message}</div>";
        }

        ?>

        <div class="form-floating mb-3" id="form">
            <input type="text" class="form-control mb-2"  id="floatingInput" name="username" placeholder="введите имя" value="<?= $username??'' ?>">
            <label class="form-label" for="floatingInput">Имя</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control mb-2" id="floatingPassword" placeholder="введите пароль">
            <label class="form-label"  for="floatingPassword">Пароль</label>
        </div>
        <!--        <recaptcha-->
        <button class="g-recaptcha w-100 btn btn-lg btn-primary"
                data-sitekey="6LfDtK0bAAAAAKn_cSB5WwE9PQSvvzv2Xz-KGCEV"
                data-callback='onSubmit'
                data-action='submit'>Login</button>




    </form>
</div>

<?php $this->endSection();



$this->section('scripts')?>

    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("login-form").submit();
        }
    </script>
<?php $this->endSection();

