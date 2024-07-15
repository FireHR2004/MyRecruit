<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCriteria extends Model
{
    use HasFactory;

    protected $table = 'sub_criteria';
    protected $fillable = [
        'criterion_id',
        'nama_sub_kriteria',
        'nilai',
    ];

    public function criterion() {
        return $this->belongsTo(Criteria::class);
    }
}
