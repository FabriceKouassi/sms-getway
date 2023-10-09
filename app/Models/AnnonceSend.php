<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AnnonceSend extends Model
{
    use HasFactory;

    protected $table = 'annonce_sends';
    protected $fillable = [
        'titre',
        'details',
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
