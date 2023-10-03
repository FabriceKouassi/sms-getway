<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $table = 'classes';
    protected $fillable = [
        'nom'
    ];

    public function eleves()
    {
        return $this->hasMany(Eleve::class, 'classe_id');
    }
}
