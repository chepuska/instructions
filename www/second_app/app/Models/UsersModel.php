<?php

namespace App\Models;
use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['username', 'password','email','age', 'status', 'id_category'];


    //получение юзера по username
    public function findUserByUsername(string $username)
    {

        return $this
            ->select('*')
            ->where('username', $username)
            ->first();
    }

    public function getRoleByUsername($username): array
    {
        return $this->select('id_category')->where('username', $username)->first();
    }
    //получаем название роли по id юзера
    public function getInformationOfUsers()
    {
        return $this->select('users.id, users.username, users.status, users.email,users.id_category, roles.category_name')
            ->join('roles','users.id_category = roles.id','left')
            ->get()->getResultArray() ;

    }

}