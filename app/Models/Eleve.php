<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Eleve extends Model
{
    use HasFactory;

    protected $table = 'eleves';
    protected $with = '_parent';
    protected $fillable = [
        'matricule',
        'nom',
        'prenoms',
        'contact',
        'parent_id',
        'classe_id',
    ];

    public function _parent()
    {
        return $this->belongsTo(_Parent::class, 'parent_id');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }

    public function absence_send(): BelongsToMany
    {
        return $this->belongsToMany(AnnonceSend::class, 'absence_sends', 'user_id', 'eleve_id');
    }
}
