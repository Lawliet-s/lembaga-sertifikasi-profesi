<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index() {
        $jurusan = Jurusan::orderBy('created_at','desc')->get();
        return view('admin.jurusan', compact('jurusan'));
    }

    public function store(Request $request) {
        $request->validate([
            'jurusan' => ['required']
        ]);
        Jurusan::create([
            'jurusan' => $request->jurusan
        ]);
        return back()->with('success', 'Jurusan Sudah Berhasil diBuat');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'jurusan' => ['required']
        ]);
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->update([
            'jurusan' => $request->jurusan
        ]);
        return back()->with('success', 'Jurusan Berhasil Diperbarui');
    }

    public function destroy($id){
        $jurusan = Jurusan::findorfail($id);
        $jurusan->delete();
        return redirect()->back()->with('success','Jurusan Berhasil Dihapus');
    }
}
