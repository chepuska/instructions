<?php
$this->extend('base');
$this->section('styles');?>

<link rel="stylesheet" href="/assets/css/table.css">

<?php
$this->endSection();
$this->section('content');
?>
<h3 class="mb-4 text-center">Отзывы</h3>

<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">id</th>
        <th scope="col">title</th>
        <th scope="col">Status</th>

    </tr>
    </thead>
    <tbody>
<!--    <input value='{$complaint['status']}' name='status'>-->
    <?php
    if(isset($complaints)){

        foreach ($complaints as $complaint){?>

        
             <tr>
                <th scope='row'><?= $complaint['id'] ?></th>
                <td><a class='item' href='listComplaint/<?= $complaint['id'] ?>'><?= $complaint['title'] ?></a></td>
                <td>
                  <form action='/changeStatus/<?= $complaint['id']?>' method='post' class="flex-select">

                      <div class="form-check form-switch">
                          <?php if($complaint['status'] == 1):?>
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
            </tr>
       
<?php

        }
    }
    ?>


    </tbody>

</table>
<?= $this->endSection() ?>


