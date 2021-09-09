<?php $this->extend('base');
$this->section('styles');?>
<style>
    .hidden{
        display:none;
    }
    .visible{
        display: block;
    }
</style>

<?php $this->endSection();
$this->section('content');?>

<div class="form pb-4">
    <h3 class="h3 mb-4 fw-normal text-center">Создание новой инструкции</h3>
<!--    <div class="alert alert-primary">-->
        <?php
        /** @var $errors \CodeIgniter\Validation\Validation */
        if(isset($errors)){
            echo $errors->listErrors();
        }
        if(isset($ex_error)){
            echo "<ul class='errors' role='alert'><li >".$ex_error."</li></ul>";
        }
        if(isset($message)){
            echo "<div class='errors ' role='alert'>{$message}</div>";
        }
        if(session()->getFlashdata('message')){
               echo "<div class='alert alert-primary'>".session()->getFlashdata('message')."</div>";
                }
        ?>

<!--    </div>-->
    <form  action="/create" method="post" enctype="multipart/form-data" >
        <?= csrf_field() ?>
        <div class="mb-3">
            <label class="form-label" for="category">Выберите категорию</label>
            <select class='p-2 ' id = "category"  name="category" >
                <?php
                $categories = session()->get('categories');
                if(isset($categories)){
                    foreach ($categories as $category){
                        echo "<option>{$category['name']}</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="mb-3">

            <label class="form-label" for="title">Заголовок</label>
            <input class="form-control" id = "title" type="text" name="title" value="<?= $title ??'' ?>"><br>
        </div>
        <div class="mb-3">
            <label class="form-label" for="descr">Краткое описание</label>
            <textarea class="form-control" name="description" id="descr" cols="50" rows="3"><?= $description ??'' ?></textarea>
        </div>
        <div class="mb-4">

            <textarea class="form-control inp-content" name="content" id="content" cols="30" rows="10" placeholder="текст инструкции"><?= $content??'' ?></textarea>
        </div>
        <div class="mb-4">

            <input  class="form-control file-content hidden" type="file" name="userfile" >
        </div>

<!--        выбор способа загрузки контента-->

        <div class="mb-4">
            <label><input class="m-3" type="radio" value="text" name="my-radio" checked >   Загрузить содержание иструкции из формы</label><br>
            <label><input class="m-3" type="radio" value="file" name="my-radio" >   Загрузить содержание иструкции из файла</label>
        </div>
        <div class="mb-4">
            <label>Выбрать картинки
                <input type="file" multiple name="pictures[]">
            </label>

        </div>
        <div>
            <input class=" btn btn-lg btn-primary" type="submit" name="create" value="Загрузить инструкцию">
        </div>


    </form>
</div>
<?php $this->endSection();
$this->section('scripts')?>
<script>
    $('input[type="radio"]').on('click ', function(e) {
        console.log(e.type);

        if ($('.inp-content').hasClass("hidden")) {
            $('.inp-content').removeClass("hidden").addClass("visible");
            $('.file-content').removeClass("visible").addClass("hidden");
        }else {
            $('.file-content').removeClass("hidden").addClass("visible");
            $('.inp-content').removeClass("visible").addClass("hidden");
        }
    });
    // ($('.file-content').hasClass("hidden"))

</script>

<?php $this->endSection()?>

