<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table='appointments';
    
    protected $fillable = [
        'customer_id',
        'service_id',
        'stylist_id',
        'salon_id',
        'schedule_id'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function service(){
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function stylist(){
        return $this->belongsTo(Stylist::class, 'stylist_id', 'id');
    }

    public function salon(){
        return $this->belongsTo(Salone::class, 'salon_id', 'id');
    }

    public function schedule(){
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }

}
