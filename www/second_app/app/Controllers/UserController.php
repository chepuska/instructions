<?php


namespace App\Controllers;
use App\Models\RoleModel;
use CodeIgniter\Controller;
use App\Models\UsersModel;
use CodeIgniter\Model;
use PHPUnit\Util\Exception;

class UserController extends Controller
{
    //получение списка юзеров
    public function userList()
    {
        $usersModel =new UsersModel();
        $users = $usersModel->getInformationOfUsers();
        $data=['users'=>$users];
        echo view('/users/userList', $data);
    }
    //получение юзера по id
    public function getUser($id){
        try {
            $usersModel =new UsersModel();
            $user = $usersModel->find($id);
            if(empty($user)){
                throw new Exception('Этого пользователя нет в БД');
            }
            $data = ['username'=>$user['username'],
                     'email'=>$user['email'],
                     'age'=>$user['age'],
                     'id_category'=>$user['id_category'],
                ];

            echo  view('/users/userForm', $data);
        }catch(\Exception $e){

            $data = ['message' => $e->getMessage()];
            echo view('error', $data);
        }
    }

    //изменение статуса юзера(true или false)
    public function changeStatusUser($id): \CodeIgniter\HTTP\RedirectResponse
    {
        helper('form');
        $status = $this->request->getVar('status');
        if($status =='on'){
            $st = true;
        }else{
            $st = null;
        }
        $usersModel = new UsersModel();
        $usersModel->set('status', $st);
        $usersModel->where('id', $id);
        $usersModel->update();

        return redirect()->to('/users');
    }
    //изменение id_category(роль) пользователя (1-admin, 2-user)
    public function changeIdCategoryUser($id){
        helper('form');
        $categoryName = $this->request->getVar('category_name');
        $roleModel = new RoleModel();
        $idCategoryUser = $roleModel->getIdByCategoryName($categoryName);

        $userModel = new UsersModel();

        $userModel->set('id_category', $idCategoryUser['id']);
        $userModel->where('id', $id);
        $userModel->update();

        return redirect()->to('/users');
    }
    //изменение пароля юзером
    public function changePassword($id)
    {
        helper('form');
        $password = password_hash($this->request->getVar('password'),PASSWORD_DEFAULT);
        $userModel = new UsersModel();
        $userModel->set('password', $password);
        $userModel->where('id', $id)->update();
        $session = session();
        $session->setFlashdata('message','вы успешно сменили пароль');
        return redirect()->to('/');

    }
    //вывод формы для создания нового юзера. Администратор
    public function outFormUser()
    {
        echo view('/users/userForm');
    }

    //для администратора
    public function addUser()
    {
        helper('form');

        $rules =[
            'username'=>'required|min_length[3]|max_length[20]',
            'password'=>'required|min_length[6]|max_length[30]',
            'confirm_password'=>'required|matches[password]',
            'email'=>'required|min_length[6]|max_length[50]|is_unique[users.email]',
            'id_category'=>'required',
        ];
        if($this->validate($rules)){
            $model = new UsersModel();
            $username= $this->request->getVar('username');
            $password = password_hash($this->request->getVar('password'),PASSWORD_DEFAULT);
            $email = $this->request->getVar('email');
            $age =  $this->request->getVar('age');
            $id_category = $this->request->getVar('id_category');
            $model->insert([
                'username'=>$username,
                'password'=>$password,
                'email'=>$email,
                'age'=>$age,
                'status'=>'active',
                'id_category'=>$id_category,
            ]);
            return redirect()->to('/users');
        }else{
            $username= $this->request->getVar('username');
            $password =  $this->request->getVar('password');
            $email = $this->request->getVar('email');
            $age =  $this->request->getVar('age');
            $id_category =$this->request->getVar('id_category');
            $errors = $this->validator;
            $data = [
                'username' =>$username,
                'email'=>$email,
                'age'=>$age,
                'password'=> $password,
                'id_category'=>$id_category,
                'validation'=>$errors,
            ];
            return view('users/userForm', $data);
        }
    }

}