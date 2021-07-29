<?php
$this->extend('base');
$this->section('styles');?>

    <link rel="stylesheet" href="/assets/css/table.css">

<?php
$this->endSection();
$this->section('content');?>

<?php if(!empty($instructions) && is_array($instructions)):?>
<h3>Список инструкций</h3>

<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Title</th>
        <th scope="col">Status</th>
        <th scope="col">Category</th>
        <th scope="col">ID Category</th>
        <th scope="col">Delete</th>

    </tr>
    </thead>
    <tbody>

    <?php
    foreach ($instructions as $instruction) {

        echo "

    <tr>
        <th scope='row'>{$instruction->id}</th>
        <td><a class='item' href='update/{$instruction->id}'>{$instruction->title}</a></td>
        <td>
            <form  class='flex' action='/activity/{$instruction->id}' method='post'>
                <input class='cell-input' type='text' value='{$instruction->status}' name='status'><br><br>
                <input type='submit' class='btn btn-primary' value='Изменить' >
            </form>
        </td>
        <td>{$instruction->name}</td>
        <td>
           
             <form action='/changeCategory/{$instruction->id}' method='post'>
                <input type='text' name='id_category' value=\" {$instruction->id_category}\"><br><br>
                <input type='submit' class='btn btn-primary' value='Изменить' >
            </form>
       
        </td>
        <td><form action='delete/{$instruction->id}' method='post'>
                <input type='submit' class='btn btn-primary' value='Удалить'>
            </form>
        </tr>

    ";
    }
    ?>


    </tbody>

</table>

        <?php endif;
    $this->endSection() ?>