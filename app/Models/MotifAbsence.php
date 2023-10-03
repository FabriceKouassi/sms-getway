<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotifAbsence extends Model
{
    use HasFactory;

    protected $table ='motif_absences';

    protected $fillable = [
        'libelle'
    ];

    public function absences()
    {
        return $this->hasMany(Absence::class, 'motif_id');
    }
}
