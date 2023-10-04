<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    protected $table = 'absences';
    protected $fillable = [
        'motif',
        'date_absence',
        'modele_id',
    ];

    public function motifs()
    {
        return $this->belongsTo(ModeleAbsence::class, 'modele_id');
    }
}
