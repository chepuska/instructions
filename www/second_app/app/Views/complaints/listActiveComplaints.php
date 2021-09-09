<?php $this->extend('base');
$this->section('styles');?>
    <link rel="stylesheet" href="/assets/css/table.css">
<?php $this->endSection();
$this->section('content');?>

    <h2 class="text-center mb-4 text-center"><?php echo $title?? ''?></h2>

<? if(isset($message)) :
    ?><div class='alert alert-primary'><?= $message?></div>
<?php elseif(session()->getFlashdata('message')!==null):
    ?><div class='alert alert-primary'><?= session()->getFlashdata('message') ?></div>

<?php endif;

if(!empty($complaints) && is_array($complaints)):?>

    <ul>
        <?php
        foreach ($complaints as $complaint){
            echo "<li class='list-group-item p-3'>
                            <a class='item' href='listActiveComplaints/{$complaint["id"]}'>{$complaint["title"]}</a>
                   </li>";
        }
        ?>

    </ul>
<?php else:?>

<?php endif;

 $this->endSection();
