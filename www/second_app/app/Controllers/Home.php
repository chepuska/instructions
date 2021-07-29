<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\InstructionsModel;
use App\Models\UsersModel;
use CodeIgniter\Controller;

class Home extends Controller
{
	public function index(): string
    {
		return view('index');
	}
	public function about()
    {
        return view('articles/about');
    }
}
