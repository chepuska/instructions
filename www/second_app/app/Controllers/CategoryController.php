<?php


namespace App\Controllers;


use App\Models\CategoryModel;
use CodeIgniter\Controller;
use CodeIgniter\Model;

class CategoryController extends Controller
{
//создание нового раздела(категории)
    public function createCategory(): \CodeIgniter\HTTP\RedirectResponse
    {
        helper('form');
        $nameCategory = $this->request->getVar('name');
        $categoryModel = new CategoryModel();
        $categoryModel->insert(['name'=>$nameCategory]);

        return redirect()->to('/listCategory');
    }


    public function listCategory(){
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->findAll();
        $data = ['categories'=>$categories];
        echo view('instruction/section', $data);
    }
}