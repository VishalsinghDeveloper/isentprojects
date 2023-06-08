<?php

namespace App\Models;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = ['description', 'cust_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cust_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
