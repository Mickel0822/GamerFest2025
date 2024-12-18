<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Inscription extends Model
{
    protected $fillable = [
        'user_id', 'game_id', 'team_name', 'member_1_id',
        'member_2_id', 'member_3_id', 'member_4_id',
        'cost', 'status', 'payment_receipt',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function member1()
    {
        return $this->belongsTo(User::class, 'member_1_id');
    }

    public function member2()
    {
        return $this->belongsTo(User::class, 'member_2_id');
    }

    public function member3()
    {
        return $this->belongsTo(User::class, 'member_3_id');
    }

    public function member4()
    {
        return $this->belongsTo(User::class, 'member_4_id');
    }

    public function getPaymentReceiptUrlAttribute()
    {
        return $this->payment_receipt
            ? Storage::disk('public')->url($this->payment_receipt)
            : null;
    }
}
