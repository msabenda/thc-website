<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;          // ← Add this
use Filament\Panel;                                 // ← Add this

class User extends Authenticatable implements FilamentUser  // ← implements here
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        // Add your custom fields if you have e.g. 'is_admin'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // This is the key method Filament calls
    public function canAccessPanel(Panel $panel): bool
    {
        // Option A: Simple – only allow specific emails (good for start)
        // return str_ends_with($this->email, '@yourcompany.com') && $this->hasVerifiedEmail();

        // Option B: If you add an 'is_admin' boolean column to users table
        // return $this->is_admin === true;   // or $this->is_admin ?? false;

        // Option C: Role-based (if you later use Spatie Permission or similar)
        // return $this->hasRole('admin');

        // For now – let's make it super simple so YOU can access:
        // Replace with your actual admin email(s)
        return true;
    }
}