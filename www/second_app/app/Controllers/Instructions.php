<?php


namespace App\Controllers;

use App\Models\CategoryModel;
use CodeIgniter\Controller;
use App\Models\InstructionsModel;
use CodeIgniter\Model;
use PHPUnit\Util\Exception;
use function PHPUnit\Framework\throwException;


class Instructions extends BaseController
{
    //вывод всех инструкций
    public function list($idCategory)
    {
        //получаем список всех инструкций
        $model =new InstructionsModel();
        $instructions = $model->getList($idCategory);

        //получаем список разделов
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getListCategory();


        $data=[
            'instructions'=>$instructions,
            'categories'=>$categories,
            'title'=>'Инструкции',
        ];
        echo view('instruction/instructionForAdmin', $data);
    }
    //вывод списка инструкций, имеющих статус- одобрено
    public function listActive()
    {
        $model = new InstructionsModel();
        $data =[
            'instructions'=>$model->getListActiveInstruction(),
             'title'=>'Инструкции',
        ];
        echo view('instruction/list', $data);
    }
    //вывод формы для написания инструкции
    public function outForm()
    {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getListCategory();
        $data = ['categories'=>$categories];
        $session = session();
        $session->set(['categories'=>$categories]);
       echo view('instruction/create', $data);
    }
    //изменение статуса инструкции (активная, заблокированная)
    public function changeStatusInstruction($id){
        helper('form');
        $status = $this->request->getVar('status');
        if($status == 'on'){
            $st = true;
        }else{
            $st = null;
        }
        $model = new InstructionsModel();
        $model->set('status', $st);
        $model->where('id', $id);
        $model->update();
        //найти по id id_category
        $currentInstruction = $model->find($id);
        $idCategory = $currentInstruction['id_category'];
        return redirect()->to("/listCategory/{$idCategory}");
    }
    //изменение категории(раздела)
    public function changeCategory($id)
    {
        helper('form');
        $categoryName = $this->request->getVar('category_name');

        $categoryModel = new CategoryModel();
        $category = $categoryModel->getIdCategoryByName($categoryName);
        $model =new InstructionsModel();
        //апдейт -смена раздела для инструкции
        $model->set('id_category', $category['id']);
        $model->where('id', $id);
        $model->update();

        return redirect()->to("/listCategory/{$category['id']}");
    }
    //вывод инструкции по id
    public function page($id, $format){
        try {
            $model = new InstructionsModel();
            $page = $model->find($id);
            if(empty($page)){
                throw new Exception('Инструкции не найдены');
            }
            //получаем строку с названиями картинок
            $imagesString = $page['images'];
            //делаем массив имен файлов
            $images = explode(';', $imagesString);
            //делаем массив имен миниатюр
            $thumbnails =[];
            foreach ($images as $image){
                $thumb = explode('.',$image);
                $thumbnail = $thumb[0]."_thumb.jpg";
                $thumbnails[] = $thumbnail;

            }
            $data=[
                'title' => $page['title'],
                'id_instruction'=>$page['id'],
                'description'=>$page['description'],
                'content' => $page['content'],
                'images'=>$images,
                'thumbnails'=>$thumbnails,
            ];
            if($format == "html"){
                echo view('instruction/page', $data);
            } else {
                echo $page["title"]."\n";
                echo $page["description"]."\n";
                echo $page["content"];
            }

        }catch(\Exception $e){
            $data=[
                'page'=>[
                    'title'=>$e->getMessage(),
                    'content'=>'404...'
                ]
            ];
            echo view('instruction/page', $data);
        }
    }


    /**
     * @throws \ReflectionException
     */
    //создание новой инструкции
    public function createInstruct()
    {
        try {
            helper('form');
            csrf_field();
            $content = "";
            $data = [];
            $rules = [
                'title' => 'required|min_length[4]',
                'description' => 'required',
                'category' => 'required',
            ];
            $instructionModel = new InstructionsModel();
            $title = $this->request->getVar('title');
            $description = $this->request->getVar('description');
            $content = $this->request->getVar('content');
            $nameCategory = $this->request->getVar('category');

            $categoryModel = new CategoryModel();
            $category = $categoryModel->getIdCategoryByName($nameCategory);

            if (!$this->validate($rules)) {
                $errors = $this->validator;
                $data = [
                    'title' => $title,
                    'description' => $description,
                    'content'=>$content,
                    'errors' => $errors,
                ];

                return view('instruction/create', $data);

            }
            //получение всех файлов-картинок из input, формирование строки из уникальных названий
            //создание папки  и перенос туда картинок
            $filenames = '';
            if($pictures = $this->request->getFiles()){
                $path = UPLOAD_PATH . '/' . session() -> get('id') . '/';
                if(!file_exists($path)){
                    mkdir($path);

                }
                foreach ($pictures['pictures'] as $pic){
                    if($pic->isValid() && !$pic->hasMoved()){
                        $newName = $pic->getRandomName();
                        //имя для миниатюры
                        $thumbnailName =explode('.',$newName);
                        $thumbnailName = $thumbnailName[0];

                        if(!empty($filenames)){
                            $filenames = $filenames . ';';
                        }
                        $filenames = $filenames .session() -> get('id')."/". $newName;
                        //сохранение картинки в нужную папку
                        $pic->move($path, $newName);
                        //создание миниатюры
                        try {
                            \Config\Services::image()
                                ->withFile($path.$newName)
                                ->resize(100,100, true, 'height')
                                ->save($path.$thumbnailName."_thumb.jpg");

                        }catch(CodeIgniter\Images\ImageException $e)
                        {
                            $error = $e->getMessage();
                        }
                    }
                }
            }
            if ($_POST['my-radio'] === 'text') {
                if (!$this->validate(['content' => 'required'])) {
                    $data = [
                        'title' => $title,
                        'description' => $description,
                    ];
                    throw new Exception('The form must be filled');
                    echo view('/instruction/create', $data);
                } else {
                    $content = $this->request->getVar('content');
                    $instructionModel->insert([
                        'title' => $title,
                        'description' => $description,
                        'content' => $content,
                        'id_category' => $category['id'],
                        'id_user'=>session()->get('id'),
                        'status' => null,
                        'images'=>$filenames,
                    ]);
                    $session = session();
                    $session->setFlashdata('message','Инструкция успешно создана');
                    return redirect()->to('/create');
                }
            } elseif ($_POST['my-radio'] === 'file') {
                $file = $this->request->getFile('userfile');
                if (!$file || !$file->isValid()) {
                    $data = [
                        'title' => $title,
                        'description' => $description,
                    ];
                    throw new Exception('The file must be selected');
                    echo view('/instruction/create', $data);
                } else {
                    $file = $this->request->getFile('userfile');
                    $stream = $file->openFile();
                    while (!$stream->eof()) {
                        if (!empty($content)) $content = $content . PHP_EOL;
                        $content = $content . $stream->fgets();
                    }
                    $instructionModel->insert([
                        'title' => $title,
                        'description' => $description,
                        'content' => $content,
                        'id_category' => $category['id'],
                        'id_user'=>session()->get('id'),
                        'status' => 'blocked',
                        'images'=>$filenames,
                    ]);
                    $session = session();
                    $session->setFlashdata('message','Инструкция создана и ждет одобрения администратора');
                    return redirect()->to('/');
                }

            }

        } catch (\Exception $e) {
            $data['ex_error'] = $e->getMessage();
        }
        echo view('instruction/create', $data);
    }

    // метод для удаления инструкции(админ)
    public function deleteInstruct( $id = null){

            $model = new InstructionsModel();


            //находим id_category по id инструкции
            $category = $model->getIdCategoryByIdInctruction($id);

            //удаляем инструкцию по id
            $instruct = $model->where('id', $id)->delete();

            if(empty($instruct)){
                $data=['message' => 'Инструкцию нельзя удалить'];
                echo view('instruction/message}', $data);
            }
            return redirect()->to("/listCategory/{$category['id_category']}");

        }
    //поиск инструкции по шаблону
    public  function searchInstruction()
    {
        helper('form');
        $rules =['search'=>'required'];
        if(!$this->validate($rules)){
            $error = $this->validator;
            $data=['error'=>$error];
            view('/', $data);
        }
        $sample = $this->request->getVar('search');
        $model = new InstructionsModel();
        $resultSearch = $model->searchInstructionBySample($sample);
        $data =[
            'title'=> 'Список найденных инструкций',
            'instructions'=>$resultSearch,
        ];
        echo view('instruction/search', $data);
    }
    // вывод формы для апдейта инструкции админом
    public function formUpdateInstruction($id)
    {
        $instructionModel = new InstructionsModel();
        $instruction = $instructionModel->find($id);

        $categoryModel = new CategoryModel();
        //название категории конкретной инструкции
        $currentCategory =$categoryModel->getCategoryNameByIdInstruction($id);
       //названия всех категорий для вывода в select
        $categories = $categoryModel->getListCategory();

        $data = [
            'id'=>$instruction['id'],
            'title'=>$instruction['title'],
            'description'=>$instruction['description'],
            'content'=>$instruction['content'],
            'currentCategoryName'=>$currentCategory['name'],
            'categories'=>$categories,
        ];
        echo view('instruction/pageForAdmin', $data);
    }
    // метод для апдейта инструкции (админ)
    public function updateInstruction()
    {
        helper('form');
        $instructionModel = new InstructionsModel();
        $id = $this->request->getVar('id');
        $title = $this->request->getVar('title');
        $description = $this->request->getVar('description');
        $content = $this->request->getVar('content');
        $categoryName = $this->request->getVar('category_name');

        $categoryModel = new CategoryModel();
        $currentCategory = $categoryModel->getIdCategoryByName($categoryName);
        $instructionModel->set('title', $title)
            ->set('description', $description)
            ->set('content', $content)
            ->set('id_category', $currentCategory['id']);
        $instructionModel->where('id', $id);
        $instructionModel->update();
        return redirect()->to("/listCategory/{$currentCategory['id']}");
    }

}




