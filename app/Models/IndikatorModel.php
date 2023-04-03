<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorModel extends Model
{
    use HasFactory;
    protected $table = 'indikator';
    protected $primaryKey = 'id_indikator';
    protected $fillable = [
        'nama_i',
        'nilai_i',
        'id_kriteria',
    ];
    public function kriteria()
    {
        return $this->belongsTo(KriteriaModel::class);
    }
    public function beasiswa()
    {
        return $this->belongsToMany(BeasiswaModel::class);
    }
}
