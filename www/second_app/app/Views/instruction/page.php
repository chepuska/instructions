<?php $this->extend('base');
$this->section('content')?>
<?php
if(isset($message)){
    echo "<p>{$message}</p>";
}?>

<h1><?php echo $title??'' ?></h1>
<h2 class="list-group-item"><?php echo $description??'' ?></h2>
<article>

    <?php
    if(isset($content)){
        $array = explode(PHP_EOL, $content);
        foreach ($array as $p) {
            echo "<p>{$p}</p>";
        }
    }
    ?>
    <a class="btn btn-primary" href="/listActive">Вернуться к каталогу</a>
</article>

<?php $this->endSection();