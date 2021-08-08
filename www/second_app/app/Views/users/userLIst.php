<?php
$this->extend('base');
$this->section('styles');?>

<link rel="stylesheet" href="/assets/css/table.css">

<?php
$this->endSection();
$this->section('content');
?>
<h3>Список пользователей</h3>

<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">id</th>
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
                <th scope='row'><?= $user['id'] ?></th>
                <td><?= $user['username'] ?></td>
                <td><?= $user['email'] ?></td>
            
                <td>
                 <form action='/changeRole/<?= $user['id'] ?>' method='post'>
                     <select class="p-2" name="category_name" >
                         <option><?= $user['category_name'] ?></option>
                             <? if($user['category_name']==='Admin'): ?>
                         <option>User</option>
                            <? else:?>
                         <option>Admin</option>
                            <? endif;?>
                     </select>
                    <input type='submit' class='btn btn-primary' value='Изменить' >
                 </form>
                  </td>
                <td>
                  <form action='/change/<?= $user['id'] ?>' method='post'>
                      <select class="p-2" name="status" >
                            <option><?= $user['status']?></option>
                                <? if($user['status']==='active'): ?>
                            <option>blocked</option>
                                <? else:?>
                            <option>active</option>
                                <? endif;?>
                      </select>

                      <input type='submit' class='btn btn-primary' value='Изменить' >
                    </form>
                </td>
                   
            </tr>
<?php } }?>


    </tbody>

</table>

<?php $this->endSection() ?>

