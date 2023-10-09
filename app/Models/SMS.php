<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SMS extends Model
{
    use HasFactory;

    protected $table = 'sms';
    protected $with = 'typeSms';

    protected $fillable = [
        'message',
        'date_envoi',
        'typesms_id'
    ];

    public function typeSms(): BelongsTo
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

    /**
     * The roles that belong to the SMS
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function annonce_send(): BelongsToMany
    {
        return $this->belongsToMany(AnnonceSend::class, 'annonce_sends', 'sms_id', 'parent_id');
    }
}
