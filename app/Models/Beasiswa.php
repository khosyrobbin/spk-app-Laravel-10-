<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    use HasFactory;
    protected $table = 'beasiswa';
    protected $primaryKey = 'beasiswa_id';
    protected $fillable = [
        'nama_b',
    ];
    // public function indikator()
    // {
    //     return $this->belongsToMany(Indikator::class);
    // }
    public function kriteria()
    {
        return $this->belongsToMany(Kriteria::class);
    }
    public function seleksi()
    {
        return $this->hasMany(seleksi::class);
    }
}
