<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelompok; // Import model Kelompok

class KelompokController extends Controller
{
    /**
     * Menampilkan daftar semua kelompok
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelompok = Kelompok::all();

        return view('kelompok.index', compact('kelompok'));
    }

    /**
     * Menampilkan detail informasi kelompok berdasarkan ID
     *
     * @param int $id ID kelompok
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kelompok = Kelompok::find($id);

        if (!$kelompok) {
            return abort(404);
        }

        return view('kelompok.show', compact('kelompok'));
    }

    /**
     * Menampilkan formulir untuk membuat kelompok baru
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kelompok.create');
    }

    /**
     * Menyimpan data kelompok baru ke database
     *
     * @param Request $request Objek Request yang berisi data formulir
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'deskripsi' => 'required',
        ]);

        $kelompok = new Kelompok;
        $kelompok->nama = $request->input('nama');
        $kelompok->deskripsi = $request->input('deskripsi');
        $kelompok->save();

        return redirect()->route('kelompok.index')->with('success', 'Kelompok baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan formulir untuk mengedit data kelompok
     *
     * @param int $id ID kelompok
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kelompok = Kelompok::find($id);

        if (!$kelompok) {
            return abort(404);
        }

        return view('kelompok.edit', compact('kelompok'));
    }

    /**
     * Memperbarui data kelompok di database
     *
     * @param Request $request Objek Request yang berisi data formulir
     * @param int $id ID kelompok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'deskripsi' => 'required',
        ]);

        $kelompok = Kelompok::find($id);

        if (!$kelompok) {
            return abort(404);
        }

        $kelompok->nama = $request->input('nama');
        $kelompok->deskripsi = $request->input('deskripsi');
        $kelompok->save();

        return redirect()->route('kelompok.show', $id)->with('success', 'Data kelompok berhasil diperbarui!');
    }

    /**
     * Menghapus data kelompok dari database
     *
     * @param int $id ID kelompok
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelompok = Kelompok::find($id);

        if (!$kelompok) {
            return abort(404);
        }

        $kelompok->delete();

        return redirect()->route('kelompok.index')->with('success', 'Kelompok berhasil dihapus!');
    }
}
