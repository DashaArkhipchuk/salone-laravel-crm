<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salons_managers extends Model
{
    use HasFactory;
    protected $table = 'salons_managers';

    protected $fillable = [
        'salon_id',
        'manager_id'
    ];
}
