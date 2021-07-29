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
        <th scope="col">idCategory</th>
        <th scope="col">Category Name</th>
        <th scope="col">Status</th>
    </tr>
    </thead>
    <tbody>

<?php
if(isset($users)){

    foreach ($users as $user){
        echo "
        
             <tr>
                <th scope='row'>{$user['id']}</th>
                <td>{$user['username']}</td>
                <td>{$user['email']}</td>
            
                <td>
                 <form action='/changeRole/{$user['id']}' method='post'>
                    <input type='text' name='id_category' value='{$user['id_category']}'>
                    <input type='submit' class='btn btn-outline-primary' value='Изменить роль' >
                 </form>
                  </td>
                  <td>{$user['category_name']}</td>
                <td>
                  <form action='/change/{$user['id']}' method='post'>
                      <input type='text' value='{$user['status']}' name='status'> 
                      <input type='submit' class='btn btn-outline-primary' value='Изменить статус' >
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

