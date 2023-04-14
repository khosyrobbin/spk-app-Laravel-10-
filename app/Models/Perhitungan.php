<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perhitungan extends Model
{
    use HasFactory;
    protected $table = 'perhitungan';

    public function indikator()
    {
        return $this->belongsToMany(Indikator::class,'perhitungan');
    }
    public function kriteria()
    {
        return $this->belongsToMany(Kriteria::class,'perhitungan');
    }
    public function beasiswa()
    {
        return $this->belongsToMany(Beasiswa::class,'perhitungan');
    }
}
    $perhitungans = Perhitungan::join('beasiswa','perhitungan.beasiswa_id','beasiswa_id')
        ->join('kriteria','perhitungan.kriteria_id','kriteria_id')
        ->join('indikator','perhitungan.indikator_id','indikator_id')
        ->get();
