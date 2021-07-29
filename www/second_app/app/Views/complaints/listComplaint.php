<?php
$this->extend('base');
$this->section('styles');?>

<link rel="stylesheet" href="/assets/css/table.css">

<?php
$this->endSection();
$this->section('content');
?>
<h3>Отзывы</h3>

<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">id</th>
        <th scope="col">title</th>
        <th scope="col">Status</th>

    </tr>
    </thead>
    <tbody>

    <?php
    if(isset($complaints)){

        foreach ($complaints as $complaint){
            echo "
        
             <tr>
                <th scope='row'>{$complaint['id']}</th>
                <td><a class='item' href='listComplaint/{$complaint['id']}'>{$complaint['title']}</a></td>
                <td>
                  <form action='/changeStatus/{$complaint['id']}' method='post'> 
                      <input value='{$complaint['status']}' name='status'> 
                      <input type='submit' class='btn btn-primary' value='Изменить статус' >
                    </form>
                </td>
            </tr>
       
        ";

        }
    }
    ?>


    </tbody>

</table>
<?php $this->endSection() ?>


