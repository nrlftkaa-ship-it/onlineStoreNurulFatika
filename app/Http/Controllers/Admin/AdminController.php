<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Admin Panel - Online Store";
        $viewData["subtitle"] = "Admin Panel";
        return view('admin.index')->with("viewData", $viewData);
    }
}
