<?php

namespace App\Http\Controllers;

use App\Models\Profiling;
use App\Models\User;
use App\Models\UserView;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();
        $user = auth()->user();
        return view('admin.user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|min:3|max:20|unique:users|regex:/^[^\s]+$/',
            'email' => 'required|email|unique:users|max:255',
            'phone' => [
                'required',
                'string',
                'regex:/^628[0-9]{8,}$/',
                Rule::unique('users')->ignore($request->user),
            ],
            'role' => 'required|in:admin,user',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => "user",
            'password' => bcrypt($request->password),
        ]);

        $ipAddress = $request->ip();
        if ($user) {
            $userView = new UserView(['user_id' => $user->id, 'ipaddress' => $ipAddress]);
            $user->views()->save($userView);
        }
        return redirect()->route('user.index')->with('success', 'berhasil tambah data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $username)
    {
        $data = User::where('username', $username)->firstOrFail();
        $profiling = Profiling::where('user_id', $data->id)->first();

        // Dapatkan atau buat record UserView berdasarkan user_id
        // $userViews = UserView::where('user_id', $data->id)->first();
        // if (!$userViews) {
        //     $userViews = new UserView();
        //     $userViews->user_id = $data->id;
        //     $userViews->views = 0; // Inisialisasi views jika baru
        //     $userViews->save();
        // }

        // Increment jumlah pengunjung setiap kali halaman dilihat
        // $userViews->increment('views');

        //mendapatakan alamat ip dan menyimpannya
        $ipAddress = $request->ip();
        $userId = $data->id;

        // Periksa apakah ada entri dengan IP address yang sama pada hari yang sama
        $existingView = UserView::where('ipaddress', $ipAddress)
            ->where('user_id', $userId)
            ->whereDate('created_at', Carbon::today())
            ->first();

        // Jika tidak ada, buat entri baru
        if (!$existingView) {
            UserView::create([
                'user_id' => $userId,
                'ipaddress' => $ipAddress,
            ]);
        } else {
            // Jika ada, perbarui kolom updated_at dengan waktu saat ini
            $existingView->update([
                'updated_at' => Carbon::now(),
            ]);
        }

        // Dapatkan semua postingan pengguna
        $posts = $data->posts;

        $projects = $posts->where('tipe', 'project')->all();
        $certificates = $posts->where('tipe', 'certificate')->all();

        // Mendapatkan data provinsi
        $path_province = public_path('location/province.json');
        $province = json_decode(File::get($path_province), true);
        $data_province = [];
        $value_province_title = null;

        foreach ($province as $key) {
            $data_province[] = [
                'id' => $key['id'],
                'title' => $key['title'],
            ];

            if ($profiling) {
                $value_province = $profiling->province;
                if ($key['id'] == $value_province) {
                    $value_province_title = $key['title'];
                }
            }
        }

        // Mendapatkan data kabupaten
        $path_regency = public_path('location/regency.json');
        $regency = json_decode(File::get($path_regency), true);
        $data_regency = [];
        $value_regency_title = null;

        foreach ($regency as $key) {
            $data_regency[] = [
                'id' => $key['id'],
                'province_id' => $key['province_id'],
                'title' => $key['title'],
                'postal_code' => $key['postal_code'],
            ];
            if ($profiling) {
                $value_regency = $profiling->regency;
                if ($key['id'] == $value_regency) {
                    $value_regency_title = $key['title'];
                }
            }
        }

        // Jika profil tidak ditemukan, inisialisasi dengan deskripsi default
        if (!$profiling) {
            $profiling = new Profiling();
            $profiling->description = "Default Description";
        }

        // Kirim data ke tampilan
        return view('admin.user.show', [
            'data' => $data,
            'posts' => $posts,
            'projects' => $projects,
            'certificates' => $certificates,
            'profiling' => $profiling,
            'value_province_title' => $value_province_title,
            'value_regency_title' => $value_regency_title,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|regex:/^[^\s]+$/|unique:users,username,' . $data->id,
            'email' => 'required|email|unique:users,email,' . $data->id,
            'phone' => [
                'required',
                'string',
                'regex:/^628[0-9]{8,}$/',
                Rule::unique('users')->ignore($data->id),
            ],
        ]);
        $input = ([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
        ]);

        $data->update($input);
        return back()->with('success', 'berhasil update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
        return redirect()->route('user.index')->with('success', 'berhasil hapus data');
    }

    public function sendWhatsapp(Request $request, $id)
    {
        $data = User::findOrFail($id);

        $profiling = Profiling::where('user_id', $data->id)->first();

        if (!$profiling) {
            return redirect()->back()->with('error', 'belum ada profiling');
        }

        $message = "Assalamuaikum Wr. Wb.\n";
        $message .= "*Nama : " . $request->name . "*\n";
        $message .= "*Email : " . $request->email . "*\n";
        $message .= "*Message : " . $request->message . "*\n\n";

        // Membuat URL dengan informasi order detail
        $url = urlencode($message);
        // Mengambil nomor WhatsApp dari .env
        $whatsappNumber = $profiling->phone;

        // Membuat URL WhatsApp dengan nomor yang diambil dari .env
        $baseurl = "https://wa.me/{$whatsappNumber}?text=" . $url;

        // dd($baseurl);
        return redirect($baseurl);
    }
}
