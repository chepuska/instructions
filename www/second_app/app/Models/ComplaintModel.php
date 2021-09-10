<?php


namespace App\Models;


use CodeIgniter\Model;

class ComplaintModel extends Model
{
    protected $table = 'complaints';
    protected $allowedFields = ['title', 'content','status','id_user', 'id_instruction'];
    public  function getListActiveComplaints(){
        return $this->where('status',1)->findAll();
    }
}