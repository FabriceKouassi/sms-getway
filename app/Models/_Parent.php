<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class _Parent extends Model
{
    use HasFactory;
    protected $table = 'parents';

    protected $fillable = [
        'nom',
        'prenoms',
        'contact',
        'adresse'
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

    public function enseigner_classes()
    {
        return $this->belongsTo(EnseignerClasse::class, 'parent_id');
    }
}
