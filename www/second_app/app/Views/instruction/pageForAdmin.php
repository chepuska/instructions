<?php $this->extend('base');
$this->section('styles');?>
    <link rel="stylesheet" href="/assets/css/style.css">
<?php $this->endSection();
$this->section('content');
?>

    <div class="form p-4">
        <form  action="/update" method="post">
            <?= csrf_field() ?>


                <input type='hidden'   name="id" value="<?= $id??'' ?>">

            <div class="mb-3">
                <label class="form-label" for="title">Заголовок</label>
                <input class="form-control" id = "title" type="text" name="title" value="<?= $title??'' ?>">
            </div>
            <div class="mb-3">
                <label class="form-label" for="descr">Краткое описание</label>
                <textarea class="form-control" name="description" id="descr" cols="30" rows="3"><?= $description??'' ?></textarea>
            </div>
            <div class="mb-4">
                <label class="form-label" for="content">Текст инструкции</label>
                <textarea class="form-control" name="content" id="content" cols="30" rows="10"><?= $content??'' ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="title">Статус</label>
                <input class="form-control" id = "title" type="text" name="status" value="<?= $status??'' ?>">
            </div>
            <div class="mb-3">
                <label class="form-label" for="idCategory">Id категории(раздела)</label>
                <input class="form-control" id = "idCategory" type="text" name="idCategory" value="<?= $idCategory??'' ?>">
            </div>
            <div class="flex">
                <input class=" btn btn-lg btn-primary " type="submit" name="create" value="Изменить инструкцию">
                <a class="btn btn-lg btn-primary" href="/listCategory">Вернуться к списку разделов</a>
            </div>

        </form>


    </div>



<?php $this->endSection()?>