<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('admin/user/index', compact('user'));
    }


    public function create()
    {
        return view('admin/user/create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'role' => ['required', 'string', 'max:50'],
            'name' => ['required', 'string', 'min:1', 'max:100'],
            'nik' => ['nullable', 'string', 'max:50', 'unique:users,nik'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:4'],
        ]);

        $user = User::create([
            'role' => $request->role,
            'name' => $request->name,
            'nik' => $request->nik,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Pastikan Spatie role juga terpasang untuk middleware role:asesor
        if ($request->role) {
            $user->syncRoles([$request->role]);
        }

        return redirect()->route('user.index')->with('success', 'Akun Pengguna Berhasil Dibuat');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin/user/show', compact('user'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => ['min:1', 'max:100', 'required'],
            'email' => ['min:3', 'required'],
            'email2' => ['email','min:3', 'max:100', 'required', 'unique:users,email2,'.auth()->id()],
        ]);

        if ($request->has('image'))
        {
            $image = $request->image;
            $new_image = time().$image->getClientOriginalName();
            $image->move('uploads/beranda_img2/', $new_image);
            $user_data = [
                'name' => $request->name,
                'nik' => $request->nik,
                'email' => $request->email,
                'sex_id' => $request->sex_id,
                'tgl_lahir' => $request->tgl_lahir,
                'negara' => $request->negara,
                'alamat' => $request->alamat,
                'tempat_lahir' => $request->tempat_lahir,
                'no_hp' => $request->no_hp,
                'postal' => $request->postal,
                'email2' => $request->email2,
                'telp' => $request->telp,
                'fax' => $request->fax,
                'email3' => $request->email3,
                'jabatan' => $request->jabatan,
                'alamat_kantor' => $request->alamat_kantor,
                'institusi' => $request->institusi,
                'password' => bcrypt($request->password),
                'image' => 'uploads/beranda_img2/'.$new_image,
            ];
        }
        else{
            $user_data = [
                'name' => $request->name,
                'nik' => $request->nik,
                'email' => $request->email,
                'sex_id' => $request->sex_id,
                'tgl_lahir' => $request->tgl_lahir,
                'negara' => $request->negara,
                'alamat' => $request->alamat,
                'tempat_lahir' => $request->tempat_lahir,
                'no_hp' => $request->no_hp,
                'postal' => $request->postal,
                'email2' => $request->email2,
                'telp' => $request->telp,
                'fax' => $request->fax,
                'email3' => $request->email3,
                'jabatan' => $request->jabatan,
                'alamat_kantor' => $request->alamat_kantor,
                'institusi' => $request->institusi,
                'password' => bcrypt($request->password),
            ];
        }
        User::whereId($id)->update($user_data);
        return back()->with('success', ' Data Profil Pengguna Berhasil diUpdate');
    }

    public function user_update2(Request $request, $id) {
        $request->validate([
            'name' => ['min:1', 'max:100', 'required'],
            'nik' => ['nullable', 'string', 'max:50'],
            'email' => ['required'],
            'password' => ['min:4', 'required'],
        ]);

        $user_data = [
            'name' => $request->name,
            'nik' => $request->nik,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];
        User::whereId($id)->update($user_data);
        return back()->with('success', ' Data Profil Pengguna Berhasil diUpdate');
    }


    public function destroy($id) {
        $user = User::findorfail($id);
        $user->delete();
        return redirect()->back()->with('success','Akun Pengguna Berhasil Dihapus');
    }
}
