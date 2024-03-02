<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table='payments';
    
    protected $fillable = [
        'currency_id',
        'customer_id',
        'service_id',
        'stylist_id',
        'value'
    ];

    public function currency(){
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function service(){
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function stylist(){
        return $this->belongsTo(Stylist::class, 'stylist_id', 'id');
    }
}
