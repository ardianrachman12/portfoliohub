<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\UserView;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $data = UserView::where('user_id', $user->id)->count();

        $viewToday = UserView::where('user_id', $user->id)
            ->whereDate('created_at', Carbon::today())
            ->count();

        $post = Post::where('user_id', $user->id)->count();

        $viewsByMonth = UserView::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as views')
            ->where('user_id', $user->id)
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Mengambil total views per bulan dalam array untuk Chart.js
        $chartData = [];
        $months = [];
        foreach ($viewsByMonth as $view) {
            $chartData[] = $view->views;
            $months[] = Carbon::create($view->year, $view->month)->format('F Y'); // Format bulan dan tahun
        }

        // dd($post);

        return view('admin.dashboard.index', compact('data', 'post', 'viewToday', 'chartData', 'months'));
    }
    public function getDataUserForChart()
    {
        $adminCount = User::where('role', 'admin')->count();
        $userCount = User::where('role', 'user')->count();

        return response()->json([
            'adminCount' => $adminCount,
            'userCount' => $userCount,
        ]);
    }

    public function getIpAddressDataForChart()
    {
        $userId = Auth::id(); // Mendapatkan user_id yang sedang login

        $ipData = DB::table('user_views')
            ->select('ipaddress', DB::raw('count(*) as total'))
            ->where('user_id', $userId) // Filter berdasarkan user_id
            ->groupBy('ipaddress')
            ->get();

        return response()->json($ipData);
    }
}
