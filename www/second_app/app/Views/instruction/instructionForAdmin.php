<?php
$this->extend('base');
$this->section('styles');?>

    <link rel="stylesheet" href="/assets/css/table.css">

<?php
$this->endSection();
$this->section('content');?>

<?php if(!empty($instructions) && is_array($instructions)):?>
<h3 class="mb-5 text-center">Список инструкций</h3>

<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">Title</th>
        <th scope="col">Status</th>
        <th scope="col">Category</th>
        <th scope="col">Delete</th>

    </tr>
    </thead>
    <tbody>

    <?php foreach ($instructions as $instruction) : ?>



    <tr>
        <td><a class='item' href='update/<?=$instruction->id ?>'><?=$instruction->title ?></a></td>
        <td>
            <form   action='/activity/<?=$instruction->id ?>' method='post' class="flex-select">

                <div class="form-check form-switch">
                    <?php if($instruction->status == 1):?>
                        <input type="checkbox" class="form-check-input" name="status" checked >
                    <?php else:?>
                        <input type="checkbox" class="form-check-input" name="status"  >
                    <?php endif; ?>

                </div>
                <div>
                    <input type='submit' class='btn btn-primary' value='Изменить' >
                </div>

            </form>
        </td>
        <td>
             <form action='/changeCategory/<?=$instruction->id ?>' method='post' class="flex-select">
                 <div>
                     <select class="form-select" name="category_name" >
                         <option ><?=$instruction->name?></option>
                         <?php if(isset($categories)){

                             foreach($categories as $category){
                                 if($category['name']!==$instruction->name){
                                     echo "<option>{$category['name']}</option>";
                                 }
                             }

                         }?>

                     </select>
                 </div>
                <div>
                    <input type='submit' class='btn btn-primary' value='Изменить' >
                </div>

            </form>
       
        </td>
        <td><form action='delete/<?=$instruction->id ?>' method='post'>
                <input type='submit' class='btn btn-primary' value='Удалить'>
            </form>
        </td>
    </tr>
<? endforeach;?>


    </tbody>

</table>

        <?php endif;
    $this->endSection() ?>