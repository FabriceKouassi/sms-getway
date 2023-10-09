<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class _Parent extends Model
{
    use HasFactory;
    protected $table = 'parents';

    protected $fillable = [
        'nom',
        'prenoms',
        'contact',
        'adresse',
        'email'
    ];

    public function eleves()
    {
        return $this->hasMany(Eleve::class, 'parent_id');
    }

    public function recevoir_sms_annonces()
    {
        return $this->hasMany(RecevoirSmsAnnonce::class, 'parent_id');
    }

    public function recevoir_sms_absences()
    {
        return $this->hasMany(RecevoirSmsAbsence::class, 'parent_id');
    }

    public function annonce_send(): BelongsToMany
    {
        return $this->belongsToMany(AnnonceSend::class, 'annonce_sends', 'sms_id', 'parent_id');
    }

}
