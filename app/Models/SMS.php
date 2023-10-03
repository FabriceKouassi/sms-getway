<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SMS extends Model
{
    use HasFactory;

    protected $table = 'sms';

    protected $fillable = [
        'message',
        'date_envoi'
    ];

    public function typeSms()
    {
        return $this->belongsTo(TypeSMS::class, 'typesms_id');
    }

    public function recevoir_sms_annonces()
    {
        return $this->hasMany(RecevoirSmsAnnonce::class, 'sms_id');
    }

    public function recevoir_sms_absences()
    {
        return $this->hasMany(RecevoirSmsAbsence::class, 'sms_id');
    }
}
