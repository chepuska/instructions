<?php $this->extend('base');
$this->section('content');?>

    <h2 class="text-center mb-4 mt-4"><?php echo $title?? ''?></h2>

<?php if(isset($message)) {

    echo "<div class='alert alert-primary'>{$message}</div>";

}
if(!empty($complaints) && is_array($complaints)):?>

    <ul>
        <?php
        foreach ($complaints as $complaint){
            echo "<li class='list-group-item p-3'>
                            <a href='listActiveComplaints/{$complaint["id"]}'>{$complaint["title"]}</a>
                   </li>";
        }
        ?>

    </ul>
<?php else:?>

<?php endif;

 $this->endSection();
