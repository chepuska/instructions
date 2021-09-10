<?php
$this->extend('base');
$this->section('styles');?>

<link  href="/assets/css/table.css" rel="stylesheet">

<?php
$this->endSection();
$this->section('content');?>
    <h3 class="mb-4 text-center">Создать новый раздел</h3>
    <div class="mb-4">
        <form action="/newCategory" method="post">
            <div class="mb-3">
                <label class="form-label" for="name">Название раздела</label>
                <input class="form-control search" id = "name" type="text" name="name" value=""><br>
            </div>
            <div>
                <input class=" btn btn-lg btn-primary send" type="submit" name="create" value="Сохранить" disabled>
            </div>
        </form>

    </div>


    <h3 class="mb-4 text-center">Список разделов</h3>
    <ul>
        <?php  if(isset($count)){
            for($i=0; $i<count($count); $i++){?>
                <li class='list-group-item'><a class='item-count' data-before= '<?= $count[$i]['count']?>' href='listCategory/<?= $count[$i]['id_category'] ?>'><?= $count[$i]['name']?></a></li>
<?php  }}?>


    </ul>

<?= $this->endSection();
$this->section('scripts')?>

    <script src="/assets/js/aside.js"></script>

<?php $this->endSection();
