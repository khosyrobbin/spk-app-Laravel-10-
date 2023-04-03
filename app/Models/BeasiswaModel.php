<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeasiswaModel extends Model
{
    use HasFactory;
    protected $table = 'beasiswa';
    protected $primaryKey = 'id_beasiswa';
    protected $fillable = [
        'nama_b',
    ];
    public function indikator()
    {
        return $this->belongsToMany(IndikatorModel::class);
    }
}
