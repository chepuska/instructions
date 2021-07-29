<?php


namespace App\Models;


use CodeIgniter\Model;

class ComplaintModel extends Model
{
    protected $table = 'complaints';
    protected $allowedFields = ['title', 'content','status'];
    public  function getListActiveComplaints(){
        return $this->where('status','active')->findAll();
    }
}