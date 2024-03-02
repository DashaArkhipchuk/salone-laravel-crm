<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table='schedules';
    
    protected $fillable = [
        'salon_id',
        'stylist_id',
        'date',
        'start_hour',
        'end_hour'
    ];

    public function salon(){
        return $this->belongsTo(Salone::class, 'salon_id', 'id');
    }

    public function stylist(){
        return $this->belongsTo(Stylist::class, 'stylist_id', 'id');
    }
}
