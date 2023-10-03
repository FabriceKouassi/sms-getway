<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    use HasFactory;

    protected $table = 'eleves';

    protected $fillable = [
        'nom',
        'prenoms',
        'contact',
        'parent_id',
        'classe_id',
    ];

    public function _parent()
    {
        return $this->belongsTo(Parent::class, 'parent_id');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }

}
