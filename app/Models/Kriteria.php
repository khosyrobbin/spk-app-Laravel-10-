<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;
    protected $table = 'kriteria';
    protected $primaryKey = 'kriteria_id';
    protected $fillable = [
        'nama_k',
        'bobot',
        'status',
    ];
    public function indikator()
    {
        return $this->hasMany(Indikator::class);
    }
    public function beasiswa()
    {
        return $this->belongsToMany(Beasiswa::class);
    }
    // public function seleksi()
    // {
    //     return $this->belongsToMany(seleksi::class);
    // }


}
