<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    public function index()
    {
        $mobils = Mobil::latest()->get();
        return view('mobil.index', compact('mobils'));
    }

    public function create()
    {
        return view('mobil.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mobil' => 'required|string|max:100',
            'buatan'     => 'required|string|max:50',
            'tahun'      => 'required|integer|min:2000|max:2030',
            'harga_sewa' => 'required|integer|min:1',
            'deskripsi'  => 'nullable|string',
        ]);

        Mobil::create($request->only(['nama_mobil','buatan','tahun','harga_sewa','deskripsi']));
        return redirect()->route('mobil.index')->with('success','Mobil berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $mobil = Mobil::findOrFail($id);
        return view('mobil.edit', compact('mobil'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mobil' => 'required|string|max:100',
            'buatan'     => 'required|string|max:50',
            'tahun'      => 'required|integer|min:2000|max:2030',
            'harga_sewa' => 'required|integer|min:1',
            'status'     => 'required|in:tersedia,disewa',
            'deskripsi'  => 'nullable|string',
        ]);

        Mobil::findOrFail($id)->update($request->only(['nama_mobil','buatan','tahun','harga_sewa','status','deskripsi']));
        return redirect()->route('mobil.index')->with('success','Mobil berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Mobil::findOrFail($id)->delete();
        return redirect()->route('mobil.index')->with('success','Mobil berhasil dihapus.');
    }

    public function print()
    {
        $mobils = Mobil::all();
        return view('mobil.print', compact('mobils'));
    }
}
