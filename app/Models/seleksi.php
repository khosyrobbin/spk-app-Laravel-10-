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
        'bobot',
        // 'status',
    ];
    public function indikator()
    {
        return $this->belongsToMany(Indikator::class)
        ->withPivot('bobot');
    }
    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class);
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
