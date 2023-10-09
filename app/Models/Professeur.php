<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Professeur extends Model
{
    use HasFactory;

    protected $table = 'professeurs';

    protected $fillable = [
        'nom',
        'prenoms',
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

    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(Classe::class, 'professeurs_classes')->withTimestamps();
    }

    public function professeur_classe()
    {
        return $this->hasManyThrough('App\Models\ProfesseurClass','App\Models\Classes','professeur_id','classe_id');
    }
}
