<?php
$this->extend('base');
$this->section('styles');?>

<link rel="stylesheet" href="/assets/css/table.css">

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
        <?php  if(isset($categories)){
            foreach ($categories as $category){?>
                <li class='list-group-item item'><a class='item' href='listCategory/<?= $category['id'] ?>'><?= $category['name']?></a></li>
<?php  }}?>

    </ul>

<?= $this->endSection();
$this->section('scripts')?>

    <script src="/assets/js/aside.js"></script>

<?php $this->endSection();
