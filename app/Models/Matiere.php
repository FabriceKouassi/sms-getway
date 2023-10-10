<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Matiere extends Model
{
    use HasFactory;

    protected $table = 'matieres';

    protected $with = 'professeurs';

    protected $fillable = [
        'nom'
    ];

    public function professeurs()
    {
        return $this->hasMany(Professeur::class, 'matiere_id');
    }

    public function absence_send(): BelongsToMany
    {
        return $this->belongsToMany(AnnonceSend::class, 'absence_sends', 'matiere_id');
    }
}
