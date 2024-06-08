<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';

    protected $fillable = [
        'id_user',
        'id_kategori',
        'id_role',
        'id_kelompok',
        'kode_anggota',
        'nama_anggota',
        'jk',
        'tgl_lahir',
        'alamat',
        'no_hp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }

    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'id_kelompok');
    }

    // Relasi tambahan (jika ada)
    // ...
}
