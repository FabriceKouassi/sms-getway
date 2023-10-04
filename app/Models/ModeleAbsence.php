<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeleAbsence extends Model
{
    use HasFactory;

    protected $table ='modele_absences';

    protected $fillable = [
        'libelle'
    ];

    public function absences()
    {
        return $this->hasMany(Absence::class, 'modele_id');
    }
}
