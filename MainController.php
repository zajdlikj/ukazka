<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\User as User;
use App\Reference as Reference;
use App\Main as Main;

class MainController extends Controller
{
    public function __construct()
    {

    }

    public function index() // show main page
    {
        $model = new Main();
        $show = $model->index();
        return view('index',['show'=>$show]);
    }

    public function showReference($postID) // show one reference
    {
        $model = new Main();
        $values = $model->showReference($postID);
        //if exist some post/reference
        if(@$values[0][0]->postID > 0) return view('nemovitosti',['show'=>$values[0],'images'=>$values[1]]);
        else return "Reference s tímto ID neexistuje";
    }
    
    public function login(Request $request) // admin - login - POST
    {
        $model = new User();
        if($model->login($request->password)) return redirect(config('config.path').'/add');
        else return "Přístup zamítnut";
    }
    
    public function showReferences() // admin - show all references
    {
        $model = new Reference();
        $values = $model->showReferences();
        if(@$values[0][0]->postID > 0) return view('admin_show',['show'=>$values[0],'images'=>$values[1]]);
        else return redirect(config('config.path').'/login');
    }
    
    public function removeReference($postID) // admin - remove reference
    {
        $model = new Reference();
        if($model->removeReference($postID)) return redirect(config('config.path').'/show');
        else return redirect(config('config.path').'/login');
    }
    
    public function isSold($postID,$stav) // admin - change state of reference - sold / not sold
    {
        $model = new Reference();
        if($model->removeReference($postID,$stav)) return redirect(config('config.path').'/show');
        else return redirect(config('config.path').'/login');
    }
    
    public function addNewForm() // admin - add new reference form
    {
        $model = new Reference();
        if($model->addNewForm()) return view('admin_add');
        else return redirect(config('config.path').'/login');
    }
    
    public function addNew(Request $request) // admin - add new reference - POST
    {
        $model = new Reference();
        if($model->addNew($request->all())) return redirect(config('config.path').'/show');
        else return redirect(config('config.path').'/login');
    }
}
