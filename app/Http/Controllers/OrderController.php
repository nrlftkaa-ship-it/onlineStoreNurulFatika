<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "My Orders - Online Store";
        $viewData["subtitle"] = "My Orders";
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $viewData["orders"] = $user->orders()->with('items.product')->get();
        return view('order.index')->with("viewData", $viewData);
    }
}