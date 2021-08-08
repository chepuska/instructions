<?php


namespace App\Controllers;


use App\Models\UsersModel;
use CodeIgniter\Controller;

class Login extends Controller
{
    public function showForm(): string
    {
        $data['title'] = 'Авторизуйтесь';

        return view("/auth-register/login", $data);
    }


    public function login()
    {
        $session = session();
        $model = new UsersModel();
        $password = $this->request->getVar('password');
        $username = $this->request->getVar('username');
        $data = $model->findUserByUsername($username);


        if(!empty($data)){

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
                    // error
                    $session->setFlashdata('message', 'Роботам вход воспрещён');
                    redirect()->to('/');
                }
                if ($response->success==true ) {
                    //Do something to denied access
                    $session->setFlashdata('message', 'вы успешно прошли');
                    $pass = $data['password'];
                    $verify_pass = password_verify($password, $pass);
                    if(!$verify_pass) {
                        $session->setFlashdata('message', 'Неправильный пароль');
                        return redirect()->to('/');
                    } else {
                        $session_data = [
                            'id' => $data['id'],
                            'username' => $data['username'],
                            'email' => $data['email'],
                            'age' => $data['age'],
                            'id_category' => $data['id_category'],
                            'status' => $data['status'],
                            'is_logged' => true,
                        ];
                        if ($data['status'] === 'active') {
                            $session->set($session_data);//!
                            $session->setFlashdata('message', 'Вы успешно вошли');
                            return redirect()->to('/profile');

                        } elseif ($data['status'] === 'blocked') {
                            $session->setFlashdata('message', 'Ваш аккаунт заблокирован');
                            return redirect()->to('/');
                        }
                    }
                }
            }

        }else{
            $session->setFlashdata('message', 'Пользователь не найден');
            return redirect()->to('/');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to('/');
    }

    public function profile()
    {
        $session = session();
        $data =['user'=>$session];
        echo view('/auth-register/profile', $data);
    }
}