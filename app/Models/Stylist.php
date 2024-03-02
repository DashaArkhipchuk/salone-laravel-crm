<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stylist extends Model
{
    use HasFactory;
    protected $table='stylists';
    
    protected $fillable = [
        'first_name',
        'last_name',
        'contact_phone',
        'contact_email',
        'user_id'
    ];

    public function salons(){
        return $this->belongsToMany(Salone::class, 'salons_stylists', 'stylist_id', 'salon_id');
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }
}
