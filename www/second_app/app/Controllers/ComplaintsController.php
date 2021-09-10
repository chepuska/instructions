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


    //создание инструкции
    public function createComplaints($instructionId){
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
            $id_user = session()->get('id');

             $model->insert([
                'title'=>$title,
                'content'=>$content,
                'status'=>'blocked',
                'id_user'=>$id_user,
                 'id_instruction'=>$instructionId,
            ]);

            session()->setFlashdata('message','Ваше сообщение успешно отправлено');

            return redirect()->to('listActiveComplaints');
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
    //вывод конкретной жалобы
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
        if($status =='on'){
            $st = true;
        }else{
            $st = null;
        }
        $complaintModel = new ComplaintModel();
        $complaintModel->set('status', $st);
        $complaintModel->where('id', $id);
        $complaintModel->update();

        return redirect()->to('/listComplaint');
    }
}