<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenceSend extends Model
{
    use HasFactory;

    protected $table = 'annonce_sends';
    protected $fillable = [
        'sms_id',
        'parent_id'
    ];

    public function sms(): BelongsTo
    {
        return $this->belongsTo(SMS::class, 'sms_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(_Parent::class, 'parent_id');
    }
}
