<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professeur extends Model
{
    use HasFactory;

    protected $table = 'professeurs';

    protected $fillable = [
        'nom',
        'prenom',
        'contact',
        'matiere_id'
    ];

    public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'matiere_id');
    }

    public function enseigner_classes()
    {
        return $this->belongsTo(EnseignerClasse::class, 'professeur_id');
    }
}
