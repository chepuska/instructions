<?php $this->extend('base');

$this->section('content')?>
<?php
if(isset($message)){
    echo "<p>{$message}</p>";
}?>
    <article class="mb-3">
<h1 class="text-center mb-3"><?php echo $title??'' ?></h1>
<h3 class="list-group-item mb-3"><?php echo $description??'' ?></h3>

    <div>
        <?php if(isset($content)): ?>

           <p><?= $content ?></p>

        <?php  endif;  ?>
    </div>
<!--        Вывод картинок. Галерея-->
        <div class="row">
<?php
    if(isset($thumbnails)){

            for($i=0; $i<count($thumbnails);$i++){?>

        <div class="col-lg-3 col-md-4 col-6 thumb">
            <a data-fancybox="gallery" href="/assets/img/upload/<?= $images[$i] ??'' ?>">
               <img class="img-fluid" src="/assets/img/upload/<?=$thumbnails[$i]?>">
            </a>
        </div>

<? } } ?>

        </div>
        <div class="mt-5 mb-5">
            <a class="btn btn-primary" href="/listActive">Вернуться к каталогу</a>
            <a  href='/complaint/<?=  $id_instruction ?? ''?>'  class='btn btn-primary'>Отзыв</a>
        </div>

</article >

<?php $this->endSection();