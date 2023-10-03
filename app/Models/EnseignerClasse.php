<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnseignerClasse extends Model
{
    use HasFactory;
    protected $table = 'enseigner_classe';
    protected $fillable = [
        'professeur_id',
        'classe_id',
        'annee_scolaire',
    ];

    public function professeur()
    {
        return $this->belongsTo(Professeur::class, 'professeur_id');
    }

    public function classe()
    {
        return $this->belongsTo(_Parent::class, 'classe_id');
    }
}
