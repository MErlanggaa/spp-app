<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SppModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Spp extends Controller
{
    public function index()
    {
        $pembayaran = SppModel::all();
        $data = [
            'title' => 'Spp | MyApp',
            'active' => 'Spp',
            'pembayaran' => $pembayaran
        ];
        return view('pembayaran.index', $data);
    }
    public function save(Request $request)
    {
        SppModel::create($request->except(['_token', 'simpan']));
        return redirect()->to(url('pembayaran'))->with('dataTambah', 'Data Berhasil di Tambah');
    }
    public function delete($id)
    {
        SppModel::destroy($id);
        return redirect()->to(url('pembayaran'))->with('dataDelete', 'Data Berhasil di Hapus');
    }
    public function edit($id)
    {
        $data = [
            'title' => 'Spp | MyApp',
            'active' => 'Spp',
            'pembayaran' => SppModel::find($id)
        ];
        return view('pembayaran.edit', $data);
    }

    public function editt(User $id)
    {
        $data = [
            'title' => 'Spp | MyApp',
            'active' => 'Akun',
            'User' => User::find($id)
        ];
    }

    public function update(Request $request, $id)
    {
        $pembayaran = SppModel::find($id);
        // $pembayaran->name = $request->name;

        return redirect()->to(url('pembayaran'))->with('dataEdit', 'Data Berhasil di Edit');
    }

    public function updatee(Request $request, User $id)
    {

        if (Auth::user()->level == 'admin') {
            if ($request->password == null) {
                $id->name = $request->name;
                $id->username = $request->username;
                $id->level = $request->level;
                $id->save();
                return redirect('akun')->with(['dataEdit' => true]);
            } else {
                $id->name = $request->name;
                $id->username = $request->username;
                $id->level = $request->level;
                $id->password = $request->password;
                $id->save();
                return redirect('akun')->with(['dataEdit' => true]);
            }
        } else {
              if ($request->password == null) {
                $id->name = $request->name;
                $id->username = $request->username;
                $id->save();
                return redirect('akun')->with(['dataEdit' => true]);
            } else {
                $id->name = $request->name;
                $id->username = $request->username;
                $id->password = $request->password;
                $id->save();
                return redirect('akun')->with(['dataEdit' => true]);
            }
        }
    }
}
