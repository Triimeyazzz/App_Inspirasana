<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori; // Import model Kategori

class KategoriController extends Controller
{
    /**
     * Menampilkan daftar semua kategori
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoris = Kategori::all();

        return view('kategoris.index', compact('kategoris'));
    }

    /**
     * Menampilkan detail informasi kategori berdasarkan ID
     *
     * @param int $id ID kategori
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return abort(404);
        }

        return view('kategoris.show', compact('kategori'));
    }

    /**
     * Menampilkan formulir untuk membuat kategori baru
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategoris.create');
    }

    /**
     * Menyimpan data kategori baru ke database
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

        $kategori = new Kategori;
        $kategori->nama = $request->input('nama');
        $kategori->deskripsi = $request->input('deskripsi');
        $kategori->save();

        return redirect()->route('kategoris.index')->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan formulir untuk mengedit data kategori
     *
     * @param int $id ID kategori
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return abort(404);
        }

        return view('kategoris.edit', compact('kategori'));
    }

    /**
     * Memperbarui data kategori di database
     *
     * @param Request $request Objek Request yang berisi data formulir
     * @param int $id ID kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'deskripsi' => 'required',
        ]);

        $kategori = Kategori::find($id);

        if (!$kategori) {
            return abort(404);
        }

        $kategori->nama = $request->input('nama');
        $kategori->deskripsi = $request->input('deskripsi');
        $kategori->save();

        return redirect()->route('kategoris.show', $id)->with('success', 'Data kategori berhasil diperbarui!');
    }

    /**
     * Menghapus data kategori dari database
     *
     * @param int $id ID kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return abort(404);
        }

        $kategori->delete();

        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
