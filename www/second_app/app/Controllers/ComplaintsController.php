<?php


namespace App\Controllers;


use App\Models\ComplaintModel;
use CodeIgniter\Controller;
use CodeIgniter\Model;

class ComplaintsController extends Controller
{
 // вывод формы для создания инструкции
    public function outForm(){
        echo view('/complaints/complaint_form');
    }

    /**
     * @throws \ReflectionException
     */
    //создание инструкции
    public function createComplaints(){
        helper('form');
        $rules=[
            'title'=>'required|min_length[4]',
            'content'=>'required|min_length[10]'
        ];
        if(!$this->validate($rules)){
            $errors = $this->validator;
            $data=[
                'title'=>$this->request->getVar('title'),
                'content'=>$this->request->getVar('content'),
                'errors'=>$errors,
            ];
            echo view('complaints/complaint_form', $data);
        }else{

            $model= new ComplaintModel();
            $title = $this->request->getVar('title');
            $content = $this->request->getVar('content');
            $model->insert([
                'title'=>$title,
                'content'=>$content,
                'status'=>'blocked',
            ]);
            $data=['message'=>'Ваше сообщение успешно отправлено'];

            echo view('complaints/listActiveComplaints', $data);
        }
    }
    //вывод жалоб на страницу admin
    public function list(){
        $complaintModel = new ComplaintModel();
        $complaints = $complaintModel->findAll();
        $data =['complaints'=>$complaints];
        echo view('complaints/listComplaint', $data);
    }
    //лист одобреных жалоб
    public function listActive()
    {
        $model = new ComplaintModel();
        $data =[
            'complaints'=>$model->getListActiveComplaints(),
            'title'=>'Отзывы',
        ];
        echo view('complaints/listActiveComplaints', $data);
    }
    public function complaint($id){
        $model =new ComplaintModel();
        $complaint = $model->find($id);
        $data=[
            'complaint'=>$complaint
        ];
        echo view('complaints/complaint', $data);
    }

    //изменение статуса инструкции (active, blocked)
    public function changeStatusComplaints($id)
    {
        helper('form');
        $status = $this->request->getVar('status');
        $complaintModel = new ComplaintModel();
        $complaintModel->set('status', $status);
        $complaintModel->where('id', $id);
        $complaintModel->update();

        return redirect()->to('/listComplaint');
    }
}