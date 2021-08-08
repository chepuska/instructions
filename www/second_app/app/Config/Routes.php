<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');

$routes->get('/login', 'Login::showForm');
$routes->post('/login', 'Login::login');

$routes->post('/register', 'RegisterController::save');
$routes->get('/register', 'RegisterController::showForm');

//выход из профайла
$routes->get('/logout','Login::logout');
//вход в профайл авторизованным пользователем
$routes->get('/profile','Login::profile', ['filter'=>'auth']);
//изменение пароля пользователем
$routes->post('/profile/(:num)','UserController::changePassword/$1', ['filter'=>'auth']);

//вывод всех записей инструкций.вывод конкретных записей
//????????????????????????????????????????????????/
$routes->get('/list/(:num).(:segment)', 'Instructions::page/$1/$2',['filter'=>'admin']);
//лист одобренных инструкций
$routes->get('/listActive','Instructions::listActive');
$routes->get('/listActive/(:num).(:segment)', 'Instructions::page/$1/$2');

//создание инструкции
$routes->get('/create','Instructions::outForm', ['filter'=>'auth']);
$routes->post('/create', 'Instructions::createInstruct', ['filter'=>'auth']);
//изменение статуса инструкции
$routes->post('/activity/(:num)', 'Instructions::changeStatusInstruction/$1',['filter'=>'admin']);

//создание нового раздела
$routes->post('/newCategory', 'CategoryController::createCategory',['filter'=>'admin']);


//изменение id_category инструкции( то есть раздела)
$routes->post('/changeCategory/(:num)', 'Instructions::changeCategory/$1' , ['filter'=>'admin']);
//изменение самой инструкции
$routes->get('listCategory/update/(:num)','Instructions::formUpdateInstruction/$1',['filter'=>'admin']);
$routes->post('/update','Instructions::updateInstruction/$1',['filter'=>'admin']);

//роут удаления инструкции
$routes->post('listCategory/delete/(:num)', 'Instructions::deleteInstruct/$1',['filter'=>'admin']);

//роут вывода списка разделов(категорий) (админ)
$routes->get('listCategory', 'CategoryController::listCategory');
//роут вывода инструкций по разделам (админ)
$routes->get('listCategory/(:num)', 'Instructions::list/$1',['filter'=>'admin']);

//вывод формы отзыва, создание отзыва
$routes->get('/complaint/(:num)', 'ComplaintsController::outForm/$1');
$routes->post('/complaint/(:num)','ComplaintsController::createComplaints/$1');

//вывод листа отзывов админу
$routes->get('/listComplaint','ComplaintsController::list',['filter'=>'admin']);
$routes->post('/listComplaint','ComplaintsController::list',['filter'=>'admin']);
$routes->get('/listComplaint/(:num)','ComplaintsController::complaint/$1',['filter'=>'admin']);
//изменение статуса отзыва (жалобы) (active, blocked)
$routes->post('/changeStatus/(:num)','ComplaintsController::changeStatusComplaints/$1',['filter'=>'admin']);

//вывод отзывов для пользователей(одобреных администратором)
$routes->get('/listActiveComplaints','ComplaintsController::listActive');
$routes->post('/listActiveComplaints','ComplaintsController::listActive');
//вывод конкретного отзыва
$routes->get('/listActiveComplaints/(:num)','ComplaintsController::complaint/$1');



//роут получения всех пользователей и одного пользователя
$routes->get('/users', 'UserController::userList', ['filter'=>'admin']);
$routes->get('/users/(:num)', 'UserController::getUser/$1',['filter'=>'admin']);

//изменение статуса пользователя (active, blocked)
$routes->post('/change/(:num)','UserController::changeStatusUser/$1', ['filter'=>'admin']);
//изменение роли пользователя (1-admin, 2- user)
$routes->post('/changeRole/(:num)','UserController::changeIdCategoryUser/$1', ['filter'=>'admin']);

//создание нового пользователя
$routes->get('/newUser', 'UserController::outFormUser', ['filter'=>'admin']);//вывод формы для создания пользователя и его изменения
$routes->post('/newUser', 'UserController::addUser', ['filter'=>'admin']);

//роут поиска инструкции по шаблону
$routes->post('/search', 'Instructions::searchInstruction');
$routes->get('/search/(:num).(:segment)', 'Instructions::page/$1/$2');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
