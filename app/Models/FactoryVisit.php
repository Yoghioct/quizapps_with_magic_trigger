<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactoryVisit extends Model
{
    use HasFactory;

    protected $table = 'factory_visit';

    protected $fillable = [
        'bus',
        'next_hotel',
        'schedule',
        'kloter',
    ];
}
