<?php


namespace App\Models;


use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table ='roles';
    protected $allowedFields =['id', 'category_name'];
    //получить id по названию роли юзера
    public function getIdByCategoryName($role){
        return $this->select('id')->where('category_name', $role)->first();
    }
}