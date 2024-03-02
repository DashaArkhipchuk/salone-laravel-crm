<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;
    protected $table='managers';
    
    protected $fillable = [
        'first_name',
        'last_name',
        'contact_phone',
        'contact_email',
        'user_id'
    ];

    public function salons()
    {
        return $this->belongsToMany(Salone::class, 'salons_managers', 'manager_id', 'salon_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
