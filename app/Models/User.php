<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Solutionforest\FilamentEmail2fa\Interfaces\RequireTwoFALogin;
use Solutionforest\FilamentEmail2fa\Trait\HasTwoFALogin;

class User extends Authenticatable implements RequireTwoFALogin
{
    use HasFactory, Notifiable, HasTwoFALogin;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'university',
        'role',
        'profile_photo',
    ];


      /**
     * Relación: Un usuario puede coordinar un juego (1:1).
     */
    public function game()
    {
        return $this->hasOne(Game::class, 'coordinator_id');
    }

    /**
     * Relación: Un usuario puede tener muchas inscripciones.
     */
    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }


    public function isCoordinator()
    {
        return $this->role === 'coordinator';
    }

    public function getAvatarUrlAttribute()
    {
        return $this->profile_photo
            ? Storage::disk('s3')->url($this->profile_photo) // Cambia a 'public' si usas almacenamiento local
            : 'https://th.bing.com/th/id/OIP.exLShyIcCt9bTvzfMmwXjwHaHa?rs=1&pid=ImgDetMain'; // URL de una imagen predeterminada
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
