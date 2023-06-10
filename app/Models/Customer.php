<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'images',
        'last_name',
        'phone',
        'email',
        'birth_date',
    
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
