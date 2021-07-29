<?php $this->extend('base');
$this->section('styles');
?>
    <link rel="stylesheet" href="/assets/css/style.css">
<?php
$this->endSection();
$this->section('content');
?>
<h2 class="text-center mb-4 mt-4"><?php echo $title?? ''?></h2>

<?php
if(!empty($instructions) && is_array($instructions)):?>
<ul>
    <?php
        foreach ($instructions as $instruction){
            echo "<li class='list-group-item p-3'>
                        <div class='flex'>
                            <a href='listActive/{$instruction["id"]}.html'>{$instruction["title"]}</a>
                            <div class='flex'>
                             <a  href='listActive/{$instruction["id"]}.txt' download='{$instruction["title"]}.txt' class='btn btn-primary'>Скачать </a>
                             <a  href='/complaint'  class=' btn btn-primary'>Отзыв</a>
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
?>

<?php $this->endSection();