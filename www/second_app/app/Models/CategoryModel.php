<?php


namespace App\Models;
use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $allowedFields =['name', 'id'];
    public function getListCategory(): array
    {
        return $this->findAll();
    }

    public function getIdCategoryByName($name)
    {
        return $this->select('*')->where(['name'=> $name])->first();
    }
}