<?php
$this->extend('base');
$this->section('styles');?>

    <link rel="stylesheet" href="/assets/css/table.css">

<?php
$this->endSection();
$this->section('content');?>

<?php if(!empty($instructions) && is_array($instructions)):?>
<h3 class="mb-4 text-center">Список инструкций</h3>

<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Title</th>
        <th scope="col">Status</th>
        <th scope="col">Category</th>
        <th scope="col">Delete</th>

    </tr>
    </thead>
    <tbody>

    <?php foreach ($instructions as $instruction) : ?>



    <tr>
        <th scope='row'><?=$instruction->id ?></th>
        <td><a class='item' href='update/<?=$instruction->id ?>'><?=$instruction->title ?></a></td>
        <td>
            <form  class='flex' action='/activity/<?=$instruction->id ?>' method='post'>
                <select class="p-2" name="status">
                    <option><?=$instruction->status ?></option>
                    <? if($instruction->status ==='active') :?>
                        <option>blocked</option>
                    <? else:?>
                        <option>active</option>
                    <? endif;?>
                </select>
                <input type='submit' class='btn btn-primary' value='Изменить' >
            </form>
        </td>
        <td>
             <form action='/changeCategory/<?=$instruction->id ?>' method='post'>
                 <select class="p-2" name="category_name" >
                     <option ><?=$instruction->name?></option>
                     <?php if(isset($categories)){

                             foreach($categories as $category){
                                 if($category['name']!==$instruction->name){
                                    echo "<option>{$category['name']}</option>";
                             }
                         }

                     }?>

                 </select>
                <input type='submit' class='btn btn-primary' value='Изменить' >
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