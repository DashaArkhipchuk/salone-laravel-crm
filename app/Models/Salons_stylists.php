<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salons_stylists extends Model
{
    use HasFactory;

    protected $table = 'salons_stylists';

    protected $fillable = [
        'salon_id',
        'stylist_id'
    ];
}
