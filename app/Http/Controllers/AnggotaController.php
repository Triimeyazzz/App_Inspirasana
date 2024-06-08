<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota; // Import model Anggotaa niii

class AnggotaController extends Controller
{
    /**
     * Menampilkan daftar semua anggotaa
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambil semua data anggota dari database ya ges yaa
        $anggotas = Anggota::all();

        // Tampilkan daftar anggota dalam view 'anggotas.index'
        // dan berikan data anggota ke view
        return view('anggotas.index', compact('anggotas'));
    }

    /**
     * Menampilkan detail informasi anggota berdasarkan ID
     *
     * @param int $id ID anggota
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Temukan anggota dengan ID yang diberikan
        $anggota = Anggota::find($id);

        // Periksa apakah anggota ditemukan
        if (!$anggota) {
            return abort(404); // Kembalikan error 404 jika tidak ditemukan
        }

        // Tampilkan detail anggota dalam view 'anggotas.show'
        // dan berikan data anggota ke view
        return view('anggotas.show', compact('anggota'));
    }

    /**
     * Menampilkan formulir untuk membuat anggota baru
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Tampilkan formulir pembuatan anggota dalam view 'anggotas.create'
        return view('anggotas.create');
    }

    /**
     * Menyimpan data anggota baru ke database
     *
     * @param Request $request Objek Request yang berisi data formulir
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data input dari formulir
        $request->validate([
            'nama' => 'required|max:255',
            'alamat' => 'required',
            'no_telepon' => 'required|numeric',
            'email' => 'required|email|unique:anggotas', // Pastikan email unik
        ]);

        // Buat objek anggota baru
        $anggota = new Anggota;

        // Isi data anggota dengan data dari request
        $anggota->nama = $request->input('nama');
        $anggota->alamat = $request->input('alamat');
        $anggota->no_telepon = $request->input('no_telepon');
        $anggota->email = $request->input('email');

        // Simpan data anggota ke database
        $anggota->save();

        // Arahkan pengguna ke halaman detail anggota yang baru dibuat
        return redirect()->route('anggotas.show', $anggota->id)->with('success', 'Anggota baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan formulir untuk mengedit data anggota
     *
     * @param int $id ID anggota
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Temukan anggota dengan ID yang diberikan
        $anggota = Anggota::find($id);

        // Periksa apakah anggota ditemukan
        if (!$anggota) {
            return abort(404); // Kembalikan error 404 jika tidak ditemukan
        }

        // Tampilkan formulir edit anggota dalam view 'anggotas.edit'
        // dan berikan data anggota ke view
        return view('anggotas.edit', compact('anggota'));
    }

    /**
     * Memperbarui data anggota di database
     *
     * @param Request $request Objek Request yang berisi data formulir
     * @param int $id ID anggota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Temukan anggota dengan ID yang diberikan
        $anggota = Anggota::find($id);

        // Periksa apakah anggota ditemukan
        if (!$anggota) {
            return abort(404); // Kembalikan error 404 jika tidak ditemukan
        }

        // Validasi data input dari formulir
        $request->validate([
            'nama' => 'required|max:255',
            'alamat' => 'required|max:300',
            'no_telepon' => 'required|email|unique:anggotas,email,' . $anggota->id,
        ]);
            // Isi data anggota dengan data baru dari request
            $anggota->nama = $request->input('nama');
            $anggota->alamat = $request->input('alamat');
            $anggota->no_telepon = $request->input('no_telepon');
            $anggota->email = $request->input('email');

            // Simpan data anggota yang diperbarui ke database
            $anggota->save();

            // Arahkan pengguna ke halaman detail anggota yang sudah diperbarui
            return redirect()->route('anggotas.show', $anggota->id)->with('success', 'Data anggota berhasil diperbarui!');

    }
        /**
     * Menghapus data anggota dari database
     *
     * @param int $id ID anggota
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Temukan anggota dengan ID yang diberikan
        $anggota = Anggota::find($id);

        // Periksa apakah anggota ditemukan
        if (!$anggota) {
            return abort(404); // Kembalikan error 404 jika tidak ditemukan
        }

        // Hapus data anggota dari database
        $anggota->delete();

        // Beri pesan bahwa data anggota telah dihapus
        return redirect()->route('anggotas.index')->with('success', 'Anggota berhasil dihapus!');
    }
}
