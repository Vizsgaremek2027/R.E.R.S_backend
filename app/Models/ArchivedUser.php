<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArchivedUser extends Model {
    protected $fillable = [
        'original_user_id',
        'name',
        'email',
        'role',
        'deleted_reason',
    ];

    public function originalUser(): BelongsTo {
        return $this->belongsTo(User::class, 'original_user_id');
    }
}