<?php

namespace App\Models;
use CodeIgniter\Model;

class InstructionsModel extends Model
{
    protected $table = 'instructions';
    protected $allowedFields = ['title','description','content', 'status', 'id_category', 'id', 'images'];
    public function getList($idCategory)
    {
        //получение всех данных для таблицы вывода всех инструкций по id_category
        //вывод данных по разделам, при нажатии на конкретный раздел
        $db = \Config\Database::connect();
        $bilder = $db->table('instructions as ins');
        $bilder->select('ins.title, ins.status, ins.id, c.name, ins.id_category')
        ->join('categories as c','c.id = ins.id_category','left')
        ->where('id_category', $idCategory);
            return $bilder->get()->getResult();

    }
    //получаем список активных инструкций
    public  function getListActiveInstruction(){
        return $this->where('status','active')->findAll();
    }
    //метод получения имени категории по id_category
    public function categoryNameByIdCategory(){
        return $this->select('c.name')->join('category as c','c.id = instructions.id_category')->groupBy('id_category');
    }
//    метод получения id_category по id инструкции
    public function getIdCategoryByIdInctruction($id)
    {
        return $this->select('id_category')->where('id', $id)->first();
    }

    //поиск по шаблону
    public function searchInstructionBySample($sample): array
    {

        $query = "select * from instructions as i
                  where i.title like '%{$sample}%' or i.description  like '%{$sample}%' or i.content like '%{$sample}%'";
        $db = \Config\Database::connect();
        return $db->query($query)->getResultArray();

    }

}
