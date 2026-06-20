<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Home Page - Online Store";
        return view('home.index')->with("viewData", $viewData);
    }

    public function about()
    {
        $viewData = [];
        $viewData["title"] = "About us - Online Store";
        $viewData["subtitle"] = "About us";
        $viewData["description"] = "This is my about me page. ...";
        $viewData["author"] = "Developed by: Nurul Fatika Mutmainah Student of Banjarmasin State Polytechnic Information Systems Study Program";
        return view('home.about')->with("viewData", $viewData);
    }
}
