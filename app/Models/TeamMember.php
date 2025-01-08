<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'inscription_id',
        'user_id',
    ];

    public function inscription()
    {
        return $this->belongsTo(Inscription::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
