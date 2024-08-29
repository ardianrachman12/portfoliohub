<?php

namespace App\Http\Controllers;

use App\Models\UserView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
    public function detail(Request $request)
    {
        $user = auth()->user();
        if ($user->role == 'admin') {
            $ipaddress = UserView::where('ipaddress', $request->ipaddress)
                ->first();
        } else {
            $ipaddress = UserView::where('user_id', $user)
                ->where('ipaddress', $request->ipaddress)
                ->first();
        }

        if (!$ipaddress) {
            abort(404, 'Data not found');
        }

        $response = Http::get("http://ip-api.com/json/{$ipaddress->ipaddress}");

        if ($response->failed()) {
            abort(404, 'API request failed');
        }
        $ipDetails = $response->json();

        $ipDetails = [
            'country' => $response->json('country') ?? 'Unknown',
            'regionName' => $response->json('regionName') ?? 'Unknown',
            'city' => $response->json('city') ?? 'Unknown',
            'zip' => $response->json('zip') ?? 'Unknown',
            'lat' => $response->json('lat') ?? 'Unknown',
            'lon' => $response->json('lon') ?? 'Unknown',
            'isp' => $response->json('isp') ?? 'Unknown',
            'org' => $response->json('org') ?? 'Unknown',
            'as' => $response->json('as') ?? 'Unknown',
            'timezone' => $response->json('timezone') ?? 'Unknown',
            'ip' => $response->json('query') ?? $ipaddress->ipaddress,
        ];
    
        return view('admin.views.detail', compact('ipaddress', 'ipDetails'));
    }
}
