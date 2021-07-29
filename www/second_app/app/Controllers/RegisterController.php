<?php


namespace App\Controllers;



use App\Models\UsersModel;
use CodeIgniter\Model;

class RegisterController extends BaseController
{
    public function showForm(){

        echo view('auth-register/register', );

    }

    /**
     * @throws \ReflectionException
     */
    public function save()
    {
        helper('form');
       $session = session();
        $rules =[
            'username'=>'required|min_length[3]|max_length[20]',
            'password'=>'required|min_length[6]|max_length[30]',
            'confirm_password'=>'required|matches[password]',
            'email'=>'required|min_length[6]|max_length[50]|is_unique[users.email]',
        ];
        if($this->validate($rules)){
            $model = new UsersModel();
            $username= $this->request->getVar('username');
            $password = password_hash($this->request->getVar('password'),PASSWORD_DEFAULT);
            $email = $this->request->getVar('email');
            $age =  $this->request->getVar('age');

            if (isset($_POST['g-recaptcha-response'])) {
                $captcha = $_POST['g-recaptcha-response'];
            } else {
                $captcha = false;
            }
            if (!$captcha) {
                redirect()->to('/');
            } else {
                $secret  = '6LfDtK0bAAAAACmfVM__hT3ntxBoo8KY4yXLohn4';
                $response = file_get_contents(
                    "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']
                );
                $response = json_decode($response);
                if ($response->success === false) {
                    //error
                    $session->setFlashdata('message', 'Роботам вход воспрещён');
                    redirect()->to('/');
                }
                if ($response->success==true )
                {
                    $model->insert([
                        'username'=>$username,
                        'password'=>$password,
                        'email'=>$email,
                        'age'=>$age,
                        'status'=>'active',
                        'id_category'=>2
                    ]);
                    $session_data = [
                        'username' => $username,
                        'email' => $email,
                        'age' => $age,
                        'is_logged' => true,
                        'status'=>'active',
                        'id_category'=>2
                    ];
                    $session->set($session_data);
                    $session->setFlashdata('message', 'Вы успешно зарегистрированы');
                    return redirect()->to('/');
                }
            }

        }else{
            $username= $this->request->getVar('username');
            $password =  $this->request->getVar('password');
            $email = $this->request->getVar('email');
            $age =  $this->request->getVar('age');
            $errors = $this->validator;
            $data = [
                'username' =>$username,
                'email'=>$email,
                'age'=>$age,
                'password'=> $password,
                'validation'=>$errors,
                ];
            return view('auth-register/register', $data);
        }
    }
}