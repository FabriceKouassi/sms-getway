<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeAnnonce extends Model
{
    use HasFactory;

    protected $table = 'type_annonces';

    protected $fillable = [
        'libelle',
    ];

    public function annonces()
    {
        return $this->hasMany(Annonce::class, 'typeannonce_id');
    }
}
