<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;


    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone',
        'password',
        'avatar',
        'roles'
    ];

    protected $hidden = [
        'password'
    ];

    protected $attributes = [
        'roles' => 'user',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'roles' => 'array'
    ];

    public function addRole(string $role)
    {
        $roles = $this->roles ?? [];

        if (!in_array('user', $roles)) {
            $roles[] = 'user';
        }

        if ($role !== 'user' && !in_array($role, $roles)) {
            $roles[] = $role;
        }

        $this->roles = array_values(array_unique($roles));
        $this->save();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::uuid();
        });
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
