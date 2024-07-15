<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $table = 'criteria';
    protected $fillable = [
        'kode_kriteria', 
        'nama_kriteria', 
        'bobot', 
        'jenis'
    ];

    public function subCriteria() {
        return $this->hasMany(SubCriteria::class, 'criterion_id');
    }
}
