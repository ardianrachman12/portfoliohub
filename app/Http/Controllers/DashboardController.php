<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\UserView;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $data = UserView::where('user_id', $user->id)->count();

        $viewToday = UserView::where('user_id', $user->id)
            ->whereDate('created_at', Carbon::today())
            ->count();

        $post = Post::where('user_id', $user->id)->count();

        $selectedMonth = $request->input('month', Carbon::now()->month);
        $selectedYear = $request->input('year', Carbon::now()->year);

        $viewsByDay = UserView::selectRaw('DAY(created_at) as day, COUNT(*) as views')
            ->where('user_id', $user->id)
            ->whereYear('created_at', $selectedYear)
            ->whereMonth('created_at', $selectedMonth)
            ->groupBy('day')
            ->orderBy('day', 'asc')
            ->get();

        $chartData = [];
        $days = [];
        foreach ($viewsByDay as $view) {
            $chartData[] = $view->views;
            $days[] = $view->day;
        }

        $months = [];
        for ($m = 1; $m <= 12; $m++) {
            $months[] = [
                'value' => $m,
                'name' => Carbon::create(null, $m)->format('F')
            ];
        }
        return view('admin.dashboard.index', compact('data', 'post', 'viewToday', 'chartData', 'days', 'months', 'selectedMonth', 'selectedYear'));
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
