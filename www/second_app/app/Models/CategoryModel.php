<?php


namespace App\Models;
use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $allowedFields =['name', 'id'];
    public function getListCategory()
    {
        return $this->select('name')->findAll();
    }

    public function getIdCategoryByName($name)
    {
        return $this->select('id')->where(['name'=> $name])->first();
    }

    //получаем название раздела по id инструкции - это нужно для вывода в select при апдейте инструкции (pageForAdmin.php)
    public function getCategoryNameByIdInstruction($id){
            return $this->select('categories.name')
                ->join('instructions', 'categories.id = instructions.id_category', 'left')
                ->where('instructions.id', $id)->first();

//        select categories.name as categoryName from categories
//left join instructions  on categories.id = instructions.id_category
//where instructions.id = 61
    }
    //получение количества инструкций в каждом разделе
    public function getCountInstructionByCategory()
    {
//        return $this->select('id_category, count(*) as count')->groupBy('id_category')->findAll();
        return $this->select('name, count(id_category) as count')
            ->join('instructions','categories.id = instructions.id_category', 'left')
            ->groupBy('categories.name')
            ->findAll();

    }
}