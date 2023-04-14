<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class seleksi extends Model
{
    use HasFactory;
    protected $table = 'seleksi';
    protected $primaryKey = 'seleksi_id';
    protected $fillable = [
        'NISN',
        'nama_siswa',
        'beasiswa_id',
    ];
    public function indikator()
    {
        return $this->belongsToMany(Indikator::class);
    }
    // public function kriteria()
    // {
    //     return $this->belongsToMany(Kriteria::class);
    // }
    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class);
    }
}
