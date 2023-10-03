<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecevoirSmsAnnonce extends Model
{
    use HasFactory;

    protected $table = 'recevoir_sms_annonces';
    protected $fillable = [
        'sms_id',
        'parent_id',
        'annonce_id',
        'date_reception'
    ];

    public function sms()
    {
        return $this->belongsTo(SMS::class, 'sms_id');
    }

    public function annonce()
    {
        return $this->belongsTo(Annonce::class, 'annonce_id');
    }

    public function _parent()
    {
        return $this->belongsTo(_Parent::class, 'parent_id');
    }
}
