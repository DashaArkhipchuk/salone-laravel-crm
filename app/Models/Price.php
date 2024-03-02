<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;
    protected $table='prices';
    
    protected $fillable = [
        'service_id',
        'stylist_id',
        'currency_id',
        'value'
    ];

    public function currency(){
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public function service(){
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function stylist()
    {
        return $this->belongsTo(Stylist::class);
    }
}
