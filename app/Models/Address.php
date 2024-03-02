<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table='addresses';
    
    protected $fillable = [
        'salone_id',
        'region',
        'district',
        'city',
        'street'
    ];

    public function salon()
    {
        return $this->belongsTo(Salone::class, 'salon_id', 'id');
    }
}
