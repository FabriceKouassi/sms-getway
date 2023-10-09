<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeSMS extends Model
{
    use HasFactory;
    protected $table = 'type_sms';

    protected $fillable = [
        'libelle',
    ];

    public function sms(): HasMany
    {
        return  $this->hasMany(SMS::class, 'typesms_id');
    }
}
