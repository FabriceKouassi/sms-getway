<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecevoirSmsAbsence extends Model
{
    use HasFactory;

    protected $table = 'recevoir_sms_absences';
    protected $fillable = [
        'sms_id',
        'eleve_id',
        'absence_id',
    ];
}
