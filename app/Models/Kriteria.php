<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriteria';
    protected $primaryKey = 'kode_kriteria';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['kode_kriteria', 'nama_kriteria', 'bobot', 'jenis'];

    public function subKriteria()
    {
        return $this->hasMany(SubKriteria::class, 'kode_kriteria', 'kode_kriteria');
    }
}
