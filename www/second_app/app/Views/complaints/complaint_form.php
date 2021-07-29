<?php $this->extend('base');

$this->section('content');?>

<div class="form p-4">
    <h3 class="h3 mb-4 fw-normal text-center">Изложите суть Вашей жалобы</h3>
    <?php
    /** @var $errors \CodeIgniter\Validation\Validation */
    if(isset($errors)){
        echo "<div class='invalid-feedback'>".$errors->listErrors()."</div>";
    }
    if(isset($message)){
        echo "<div class='valid-feedback'>{$message}</div>";
    }

    ?>
    <form  action="" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label class="form-label" for="title">Краткое описание</label>
            <textarea class="form-control" name="title" id="content" cols="30" rows="2"><?= $title??'' ?></textarea>
        </div>

        <div class="mb-4">
            <label class="form-label" for="content">Текст </label>
            <textarea class="form-control" name="content" id="content" cols="30" rows="10"><?= $content??'' ?></textarea>
        </div>
        <div>
            <input class=" btn btn-lg btn-primary" type="submit" name="submit" value="Отправить сообщение">
        </div>
    </form>
</div>
<?php $this->endSection()?>
