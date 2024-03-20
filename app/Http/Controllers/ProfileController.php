<?php

namespace App\Http\Controllers;

use App\Models\Profiling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $user = null;
        $profiling = null;
        $value_province_title = null;
        $value_regency_title = null;

        if (auth()->check()) {
            $user = auth()->user();
            $profiling = Profiling::where('user_id', $user->id)->first();

            // Set $value_province_title jika $profiling->province terisi
            if ($profiling && isset($profiling->province)) {
                $path_province = public_path('location/province.json');
                $province = json_decode(File::get($path_province), true);

                foreach ($province as $key) {
                    if ($key['id'] == $profiling->province) {
                        $value_province_title = $key['title'];
                        break;
                    }
                }
            }

            // Set $value_regency_title jika $profiling->regency terisi
            if ($profiling && isset($profiling->regency)) {
                $path_regency = public_path('location/regency.json');
                $regency = json_decode(File::get($path_regency), true);

                foreach ($regency as $key) {
                    if ($key['id'] == $profiling->regency) {
                        $value_regency_title = $key['title'];
                        break;
                    }
                }
            }
        }

        // Retrieve province data
        $path_province = public_path('location/province.json');
        $province = json_decode(File::get($path_province), true);
        $data_province = [];

        foreach ($province as $key) {
            $data_province[] = [
                'id' => $key['id'],
                'title' => $key['title'],
            ];
        }

        $path_regency = public_path('location/regency.json');
        $regency = json_decode(File::get($path_regency), true);
        $data_regency = [];

        foreach ($regency as $key) {
            $data_regency[] = [
                'id' => $key['id'],
                'province_id' => $key['province_id'],
                'title' => $key['title'],
                'postal_code' => $key['postal_code'],
            ];
        }

        return view('admin.profile.index', [
            'user' => $user,
            'data_province' => $data_province,
            'data_regency' => $data_regency,
            'profiling' => $profiling,
            'value_province_title' => $value_province_title,
            'value_regency_title' => $value_regency_title,
        ]);
    }

    public function updateProfile(Request $request)
    {
        // Mendapatkan user yang sedang login
        $user = auth()->user();

        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|regex:/^[^\s]+$/|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => [
                'required',
                'string',
                'regex:/^628[0-9]{8,}$/',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        // Mengupdate data user
        $params = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        $user->update($params);

        return redirect()->route('profile.index')->with('success', 'Berhasil update data');
    }

    public function profiling(Request $request)
    {
        $user = auth()->user();
        $profiling = Profiling::where('user_id', $user->id)->first();

        $data = new Profiling;

        if ($profiling) {
            if ($request->hasFile('avatar')) {
                File::delete('uploads/avatar/' . $profiling->avatar);
                $gambar = $request->file('avatar');
                $extensi = $gambar->extension();
                $nama_gambar = time() . rand(1, 9) . '.' . $extensi;
                $gambar->move(public_path('uploads/avatar'), $nama_gambar);

                $params = [
                    'user_id' => $user->id,
                    'district' => $request->district,
                    'subdistrict' => $request->subdistrict,
                    'province' => $request->province,
                    'regency' => $request->regency,
                    'postal_code' => $request->postal_code,
                    'description' => $request->description,
                    'links' => $request->links,
                    'jobs' => $request->jobs,
                    'whatsapp' => $user->phone,
                    'avatar' => $nama_gambar,
                ];
            } else {
                $params = [
                    'user_id' => $user->id,
                    'district' => $request->district,
                    'subdistrict' => $request->subdistrict,
                    'province' => $request->province,
                    'regency' => $request->regency,
                    'postal_code' => $request->postal_code,
                    'description' => $request->description,
                    'links' => $request->links,
                    'jobs' => $request->jobs,
                    'whatsapp' => $user->phone,
                ];
            }
            $profiling->update($params);
        } else {
            if (!$request->hasFile('avatar')) {
                return back()->with('error', 'Gambar harus diisi');
            }

            $gambar = $request->file('avatar');
            $extensi = $gambar->extension();
            $nama_gambar = time() . rand(1, 9) . '.' . $extensi;
            $gambar->move(public_path('uploads/avatar'), $nama_gambar);

            $params = [
                'user_id' => $user->id,
                'district' => $request->district,
                'subdistrict' => $request->subdistrict,
                'province' => $request->province,
                'regency' => $request->regency,
                'postal_code' => $request->postal_code,
                'description' => $request->description,
                'links' => $request->links,
                'jobs' => $request->jobs,
                'whatsapp' => $user->phone,
                'avatar' => $nama_gambar,
            ];
            $data->create($params);
        }

        // dd($data->create($params));

        return redirect()->route('profile.index')->with('success', 'berhasil update data');
    }

    public function selectProvince(Request $request)
    {
        $id_province = $request->id_province;
        $path_regency = public_path('location/regency.json');
        $regency = json_decode(File::get($path_regency), true);

        $data_regency = [];
        $data_postal_codes = [];

        foreach ($regency as $key) {
            if ($key['province_id'] == $id_province) {
                $data_regency[] = [
                    'id' => $key['id'],
                    'title' => $key['title'],
                ];
            }
        }

        return response()->json(['regency' => $data_regency, 'postal_codes' => $data_postal_codes]);
    }

    public function selectRegency(Request $request)
    {
        $id_destination = $request->id_destination;
        $path_regency = public_path('location/regency.json');
        $regency = json_decode(File::get($path_regency), true);

        $postal_code = [];

        foreach ($regency as $key) {
            if ($key['id'] == $id_destination) {
                $postal_code[] = [
                    'postal_code' => $key['postal_code'],
                ];
            }
        }
        return response()->json(['postal_code' => $postal_code]);
    }

    public function updatePassword(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Ambil pengguna yang sedang masuk
        $user = auth()->user();

        // Periksa apakah kata sandi saat ini cocok
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Ubah kata sandi pengguna
        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password has been updated successfully.');
    }
}
