s<?php $this->extend('base');
$this->section('styles');
?>
<link rel="stylesheet" href="/assets/css/style.css">
<?php
$this->endSection();
$this->section('content')?>

<?php
if(!empty($instructions) && is_array($instructions)):?>
    <h3 class="text-center mb-5">По вашему запросу найдены следующие инструкции :</h3>
    <ul>
        <?php
        foreach ($instructions as $instruction){
            echo "<li class='list-group-item p-3'>
                        <div class='flex'>
                            <a href='search/{$instruction['id']}.html'>{$instruction['title']}</a>
                            <div>
                                 <a href='search/{$instruction['id']}.txt' download='{$instruction['title']}.txt' class='btn btn-primary'>Скачать </a>

                             </div>
                        </div>        
                   </li>";
        }
        ?>

    </ul>
<?php else:?>
    <h3>Нет инструкций.</h3>
<?php endif;
if(isset($message)){
    echo "<p>{$message}</p>";
}
$this->endSection();
?>
