<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserModule extends Model
{
    protected $fillable = [
        'user_id',
        'module_id',
        'active',
    ];

    public function modules () : BelongsTo
    {
         return $this->belongsTo(Module::class, 'module_id');
    }
}
