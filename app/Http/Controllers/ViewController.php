<?php

namespace App\Http\Controllers;

use App\Models\UserView;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $data = UserView::with('users')->get();
        } else {
            $data = UserView::with('users')->where('user_id', auth()->user()->id)->get();
        }
        return view('admin.views.index', compact('data'));
    }
}
