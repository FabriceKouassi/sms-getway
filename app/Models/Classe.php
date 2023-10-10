<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Classe extends Model
{
    use HasFactory;

    protected $table = 'classes';
    protected $with = ['professeurs'];
    protected $fillable = [
        'nom'
    ];

    public function eleves()
    {
        return $this->hasMany(Eleve::class, 'classe_id');
    }

    public function enseigner_classe()
    {
        return $this->hasMany(EnseignerClasse::class, 'classe_id');
    }

    public function professeurs(): BelongsToMany
    {
        return $this->belongsToMany(Professeur::class, 'professeurs_classes')->withTimestamps();
    }

    public function professeur_classe()
    {
        return $this->hasManyThrough(Professeur::class,Classe::class,'professeur_id','classe_id');
    }
}
