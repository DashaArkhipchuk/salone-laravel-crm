<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table='services';
    
    protected $fillable = [
        'name',
        'description'
    ];

    public function prices(){
        return $this->hasMany(Price::class, 'service_id');
    }
}
