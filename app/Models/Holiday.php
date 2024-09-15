<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;
    protected $fillable = [
        'occasion',
        'date',
        'user_id'
    ];
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
