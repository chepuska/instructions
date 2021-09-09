<?php
$this->extend('base');
$this->section('styles');?>

<link  href="/assets/css/table.css" rel="stylesheet">

<?php
$this->endSection();
$this->section('content');
?>
<h3 class="mb-5 text-center">Список пользователей</h3>

<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">Username</th>
        <th scope="col">Email</th>
        <th scope="col">Role Users</th>
        <th scope="col">Status</th>
    </tr>
    </thead>
    <tbody>

<?php
if(isset($users)){

    foreach ($users as $user){ ?>

             <tr>
                <td><?= $user['username'] ?></td>
                <td><?= $user['email'] ?></td>
            
                <td class="for-select">
                 <form action='/changeRole/<?= $user['id'] ?>' method='post' class="flex-select">
                        <div>
                            <select class="form-select" name="category_name" >
                                <option><?= $user['category_name'] ?></option>
                                <? if($user['category_name']==='Admin'): ?>
                                    <option>User</option>
                                <? else:?>
                                    <option>Admin</option>
                                <? endif;?>
                            </select>
                        </div>
                            <div> <input type='submit' class='btn btn-primary' value='Изменить' >
                        </div>



                 </form>
                  </td>
                <td>
                  <form action='/change/<?= $user['id'] ?>' method='post' class="flex-select">

                      <div class="form-check form-switch">
                          <?php if($user['status'] == 1):?>
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
<?php } }?>


    </tbody>

</table>

<?php $this->endSection() ?>

