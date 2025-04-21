<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $table = 'user';

    protected $guarded = ['id_user'];

    protected $primaryKey = 'id_user';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function levels()
    {
        return $this->hasMany(Level::class, 'id_user', 'id_user');
    }

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

    // Fungsi membuat relasi tabel 
    public function staff(): HasOne
    {
        return $this->hasOne(Staff::class, 'id_user', 'id_user');
    }

    public function student(): HasOne
    {
        return $this->hasOne(Student::class, 'id_user', 'id_user');
    }

    public function guardian(): HasOne
    {
        return $this->hasOne(Guardian::class, 'id_user', 'id_user');
    }

    public function level(): HasMany
    {
        return $this->hasMany(Level::class, 'id_user', 'id_user');
    }
}
