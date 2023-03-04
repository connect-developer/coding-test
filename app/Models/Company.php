<?php

namespace App\Models;

use App\Core\Entity\BaseEntity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends BaseEntity
{
    use HasFactory;

    protected $fillable = [
        'name',
        'about',
        'address',
        'phone_number'
    ];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
