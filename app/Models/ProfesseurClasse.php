<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfesseurClasse extends Model
{
    use HasFactory;

    protected $table = 'professeurs_classes';
    // protected $with = ['professeurs', 'classes'];
    protected $fillable = [
        'professeur_id',
        'classe_id'
    ];

    public function professeurs()
    {
        return $this->belongsTo(Professeur::class, 'professeur_id');
    }

    public function classes()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }
}
