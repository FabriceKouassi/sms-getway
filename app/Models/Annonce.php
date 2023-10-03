<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;

    protected $table = 'annonces';

    protected $fillable = [
        'titre',
        'description',
        'typeannonce_id'
    ];

    public function typeAnnonce()
    {
        return $this->belongsTo(TypeAnnonce::class, 'typeannonce_id');
    }

    public function recevoir_sms_annonces()
    {
        return $this->hasMany(RecevoirSmsAnnonce::class, 'annonce_id');
    }
}
