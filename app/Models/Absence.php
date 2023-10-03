<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    protected $table = 'absences';
    protected $fillable = [
        'description',
        'date_absence',
        'motif_id',
    ];

    public function motifs()
    {
        return $this->belongsTo(MotifAbsence::class, 'motif_id');
    }
}
