<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\UserView;

class DashboardController extends Controller
{
    public function index(){
        $user = auth()->user();
        $data = UserView::where('user_id', $user->id)->first();

        $post = Post::where('user_id', $user->id)->count();

        // dd($post);

        return view('admin.dashboard.index', compact('data', 'post'));
    }
    public function getDataUserForChart() {
        $adminCount = User::where('role', 'admin')->count();
        $userCount = User::where('role', 'user')->count();
    
        return response()->json([
            'adminCount' => $adminCount,
            'userCount' => $userCount,
        ]);
    }
}
