<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    use HasFactory;
    protected $table = 'indikator';
    protected $primaryKey = 'indikator_id';
    protected $fillable = [
        'nama_i',
        'nilai_i',
        'kriteria_id',
    ];
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
    public function seleksi()
    {
        return $this->belongsToMany(seleksi::class)
        ->withPivot('bobot','status');
    }
}
