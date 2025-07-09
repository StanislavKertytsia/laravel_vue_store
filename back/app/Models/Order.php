<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $table = 'orders';

    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'user_id',
        'total',
        'status',
    ];


    protected $attributes=[
      'status'=>'pending',
    ];

    protected $casts = [
        'total' => 'float',
    ];
    protected static function boot(){
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::uuid();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function products()
    {
        return $this
            ->belongsToMany(Product::class)
            ->withPivot('quantity')
            ->withTimestamps();
    }

}
